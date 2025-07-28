<?php
require_once __DIR__.'/../koneksi.php';

$user_id = $_SESSION['user_id'] ?? 0;
$max_tugas = 5;

// Hitung progress
$total = $koneksi->query("SELECT COUNT(*) FROM tugashome WHERE user_id = $user_id")->fetch_row()[0];
$selesai = $koneksi->query("SELECT COUNT(*) FROM tugashome WHERE user_id = $user_id AND status = 'selesai'")->fetch_row()[0];
$progress = $total > 0 ? min(round(($selesai/$max_tugas)*100), 100) : 0;
?>

<link rel="stylesheet" href="style.css">

<div class="task-progress">
  <div class="progress-header">
    <span class="progress-label">Progress Tugas (<?= $selesai ?>/<?= $max_tugas ?>)</span>
    <span class="progress-value"><?= $progress ?>%</span>
  </div>
  <div class="progress-bar">
    <div class="progress" style="width: <?= $progress ?>%"></div>
  </div>
</div>

<?php
$query = "SELECT t.*, 
          (SELECT COUNT(*) FROM tugas WHERE tugas.nama_tugas = t.nama_tugas AND user_id = $user_id) as is_submitted
          FROM tugashome t 
          WHERE t.user_id = $user_id 
          ORDER BY t.deadline ASC";

$result = $koneksi->query($query);

while($tugas = $result->fetch_assoc()):
    $isSubmitted = $tugas['is_submitted'] > 0 || $tugas['status'] === 'selesai';
    $deadline = strtotime($tugas['deadline']);
    $currentTime = time();
    
    if (!$deadline) {
        $deadline = $currentTime;
    }
    
    $isLate = !$isSubmitted && ($deadline < $currentTime);
    $daysLate = $isLate ? floor(($currentTime - $deadline) / 86400) : 0;
?>
  <div class="task-card">
    <h3 class="task-title"><?= htmlspecialchars($tugas['nama_tugas']) ?></h3>
    
    <div class="status-container">
      <span class="status-badge <?= $isSubmitted ? 'selesai' : 'belum' ?>">
          <?= $isSubmitted ? 'Selesai' : 'Belum' ?>
      </span>
      
      <?php if ($isLate): ?>
        <span class="late-tag">
          <i class="fas fa-exclamation-triangle"></i> Terlambat <?= $daysLate ?> hari
        </span>
      <?php endif; ?>
    </div>
    
    <p><?= htmlspecialchars($tugas['mata_kuliah']) ?></p>
    
    <button class="submit-btn <?= $isSubmitted ? 'btn-submitted' : '' ?>" 
            onclick="<?= $isSubmitted ? '' : "window.location.href='kumpulkan.php?task_id={$tugas['id']}'" ?>"
            <?= $isSubmitted ? 'disabled' : '' ?>>
        <?= $isSubmitted ? 'Sudah Dikumpulkan' : 'Kumpulkan' ?>
    </button>
    
    <div class="due-date">
      <i class="fas fa-calendar-alt"></i>
      Deadline: <?= date('d M Y', $deadline) ?>
      <?php if ($isLate): ?>
        <span style="color: #c62828; margin-left: 5px;">
          (Deadline telah lewat)
        </span>
      <?php endif; ?>
    </div>
  </div>
<?php endwhile; ?>
