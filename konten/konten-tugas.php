<?php
require_once __DIR__.'/../koneksi.php';

// Debug: Cek session dan user
// var_dump($_SESSION);

$user_id = $_SESSION['user_id'] ?? 0;
$max_tugas = 5;

// Hitung progress
$total = $koneksi->query("SELECT COUNT(*) FROM tugashome WHERE user_id = $user_id")->fetch_row()[0];
$selesai = $koneksi->query("SELECT COUNT(*) FROM tugashome WHERE user_id = $user_id AND status = 'selesai'")->fetch_row()[0];
$progress = $total > 0 ? min(round(($selesai/$max_tugas)*100), 100) : 0;
?>

<div class="task-progress">
  <!-- ... bagian progress tetap sama ... -->
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
    
    // Debug: Tampilkan data deadline
    // echo "Debug - Deadline DB: " . $tugas['deadline'] . "<br>";
    
    $deadline = strtotime($tugas['deadline']);
    $currentTime = time();
    
    // Pastikan deadline valid
    if (!$deadline) {
        $deadline = $currentTime; // Jika parsing gagal
    }
    
    $isLate = !$isSubmitted && ($deadline < $currentTime);
    $daysLate = $isLate ? floor(($currentTime - $deadline) / 86400) : 0;
    
    // Debug: Tampilkan status
    // echo "Debug - Task: " . $tugas['nama_tugas'] . " | Submitted: " . ($isSubmitted ? 'Y' : 'N') . " | Late: " . ($isLate ? 'Y' : 'N') . " | Days: " . $daysLate . "<br>";
?>
  <div class="task-card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <span class="status-badge <?= $isSubmitted ? 'selesai' : 'belum' ?>">
          <?= $isSubmitted ? 'Selesai' : 'Belum' ?>
      </span>
      
      <?php if ($isLate): ?>
        <span class="late-badge" style="background-color: #ffebee; color: #c62828; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
          <i class="fas fa-exclamation-triangle"></i> Terlambat <?= $daysLate ?> hari
        </span>
      <?php endif; ?>
    </div>
    
    <h3 class="task-title"><?= htmlspecialchars($tugas['nama_tugas']) ?></h3>
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
