// ===== ELEMENTS =====
const overlay = document.getElementById("overlay");
const kelasSheet = document.getElementById("kelas-sheet");
const materiSheet = document.getElementById("materi-sheet");
const diskusiSheet = document.getElementById("Diskusi-sheet");
const tokoSheet = document.getElementById("toko-sheet");
const activityTags = document.getElementById("activity-tags");
const seeAllLink = document.getElementById("see-all-link");
const sheets = [kelasSheet, materiSheet, diskusiSheet, tokoSheet];

// ===== AKTIVITAS MASTER =====
const aktivitasMaster = {
  Beranda: {
    id: 0,
    judul: "Beranda",
    waktu: "Baru saja",
    icon: "home",
    color: "teal",
  },
  "Kelas Saya": {
    id: 1,
    judul: "Kelas Saya",
    waktu: "Baru saja",
    icon: "chalkboard-teacher",
    color: "pink",
  },
  "Materi Kuliah": {
    id: 2,
    judul: "Materi Kuliah",
    waktu: "Baru saja",
    icon: "book",
    color: "purple",
  },
  "Diskusi Kelas": {
    id: 3,
    judul: "Diskusi Kelas",
    waktu: "Baru saja",
    icon: "comments",
    color: "blue",
  },
  Toko: {
    id: 4,
    judul: "Toko",
    waktu: "Baru saja",
    icon: "shopping-cart",
    color: "orange",
  },
  Tugas: {
    id: 5,
    judul: "Tugas",
    waktu: "Baru saja",
    icon: "tasks",
    color: "green",
  },
  Pesan: {
    id: 6,
    judul: "Pesan",
    waktu: "Baru saja",
    icon: "comment-alt",
    color: "indigo",
  },
  Profil: {
    id: 7,
    judul: "Profil",
    waktu: "Baru saja",
    icon: "user",
    color: "gray",
  },
};

document.addEventListener("DOMContentLoaded", function () {
  const hariList = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
  const today = new Date();

  // Data lengkap program studi dan mata kuliah
  const prodiMatkul = {
    "Prodi Teknik Informatika": [
      "Algoritma dan Pemrograman",
      "Struktur Data",
      "Basis Data",
      "Pemrograman Berorientasi Objek",
      "Jaringan Komputer",
      "Pemrograman Web",
      "Sistem Operasi",
      "Kecerdasan Buatan",
      "Machine Learning",
      "Pengembangan Aplikasi Mobile",
    ],
    "Prodi Sistem Informasi": [
      "Sistem Basis Data",
      "Analisis dan Desain Sistem",
      "Manajemen Proyek TI",
      "Sistem Enterprise",
      "E-Bisnis",
      "Interaksi Manusia-Komputer",
      "Keamanan Sistem Informasi",
      "Data Warehouse",
      "Business Intelligence",
      "Manajemen Sistem Informasi",
    ],
    "Prodi Sistem Komputer": [
      "Arsitektur Komputer",
      "Organisasi Komputer",
      "Sistem Digital",
      "Jaringan Komputer",
      "Sistem Embedded",
      "Robotika",
      "Internet of Things",
      "Sistem Tertanam Real-Time",
      "Keamanan Jaringan",
      "Komputasi Paralel",
    ],
    "Prodi Teknik Industri": [
      "Pengantar Teknik Industri",
      "Statistika Industri",
      "Ergonomi",
      "Manajemen Operasi",
      "Logistik dan Rantai Pasok",
      "Perencanaan dan Pengendalian Produksi",
      "Sistem Manufaktur",
      "Kualitas dan Keandalan",
      "Simulasi Sistem",
      "Ekonomi Teknik",
    ],
    "Prodi Teknik Elektro": [
      "Rangkaian Listrik",
      "Elektronika Dasar",
      "Sistem Digital",
      "Medan Elektromagnetik",
      "Sistem Kendali",
      "Mikroprosesor",
      "Telekomunikasi",
      "Pembangkit Tenaga Listrik",
      "Instalasi Listrik",
      "Robotika Industri",
    ],
    "Prodi Teknik Arsitektur": [
      "Dasar Perancangan Arsitektur",
      "Gambar Arsitektur",
      "Sejarah Arsitektur",
      "Struktur Bangunan",
      "Utilitas Bangunan",
      "Arsitektur Lingkungan",
      "Perancangan Kota",
      "Arsitektur Interior",
      "Teknologi Bangunan",
      "Arsitektur Tropis",
    ],
    "Prodi Teknik Sipil": [
      "Mekanika Teknik",
      "Struktur Beton",
      "Struktur Baja",
      "Mekanika Tanah",
      "Teknik Pondasi",
      "Manajemen Konstruksi",
      "Hidrologi",
      "Transportasi",
      "Teknik Lingkungan",
      "Perencanaan Wilayah",
    ],
    "Perencanaan Wilayah dan Kota": [
      "Dasar Perencanaan",
      "Tata Ruang Kota",
      "Transportasi Perkotaan",
      "Perencanaan Wilayah",
      "Sistem Informasi Geografis",
      "Perencanaan Infrastruktur",
      "Ekonomi Perkotaan",
      "Perencanaan Lingkungan",
      "Perencanaan Pariwisata",
      "Kebijakan Pembangunan",
    ],
    "Prodi Teknik Robotika dan Kecerdasan Buatan": [
      "Dasar Robotika",
      "Pemrograman Robot",
      "Sistem Sensor dan Aktuator",
      "Kecerdasan Buatan untuk Robot",
      "Computer Vision",
      "Machine Learning",
      "Robotika Industri",
      "Robotika Cerdas",
      "Sistem Otonom",
      "Proyek Robotika",
    ],
    "Prodi Manajemen Informatika": [
      "Pemrograman Dasar",
      "Manajemen Database",
      "Sistem Informasi Manajemen",
      "Pemrograman Bisnis",
      "Jaringan Komputer",
      "Keamanan Sistem",
      "Analisis Bisnis",
      "Manajemen Proyek TI",
      "E-Commerce",
      "Sistem Pendukung Keputusan",
    ],
    "Komputerisasi Akuntansi": [
      "Akuntansi Keuangan",
      "Akuntansi Biaya",
      "Sistem Informasi Akuntansi",
      "Audit Sistem Informasi",
      "Perpajakan Digital",
      "Penganggaran Perusahaan",
      "Manajemen Keuangan",
      "Software Akuntansi",
      "Analisis Laporan Keuangan",
      "Blockchain untuk Akuntansi",
    ],
    "Keuangan dan Perbankan": [
      "Manajemen Keuangan",
      "Akuntansi Bank",
      "Manajemen Risiko Bank",
      "Perbankan Syariah",
      "Investasi dan Portofolio",
      "Pasar Modal",
      "Manajemen Kredit",
      "Fintech",
      "Analisis Laporan Keuangan",
      "Perencanaan Keuangan",
    ],
    "Manajemen Pemasaran": [
      "Dasar Pemasaran",
      "Perilaku Konsumen",
      "Manajemen Pemasaran Strategik",
      "Pemasaran Digital",
      "Manajemen Merek",
      "Komunikasi Pemasaran",
      "Pemasaran Internasional",
      "Riset Pemasaran",
      "Manajemen Ritel",
      "E-Commerce",
    ],
    "Desain Grafis": [
      "Dasar Desain Grafis",
      "Tipografi",
      "Desain Logo",
      "Desain Poster",
      "Fotografi Digital",
      "Ilustrasi Digital",
      "Animasi 2D",
      "Desain Kemasan",
      "User Interface Design",
      "Desain Editorial",
    ],
    "Prodi Akuntansi": [
      "Akuntansi Keuangan",
      "Akuntansi Biaya",
      "Akuntansi Manajemen",
      "Auditing",
      "Perpajakan",
      "Sistem Informasi Akuntansi",
      "Akuntansi Sektor Publik",
      "Akuntansi Internasional",
      "Akuntansi Perbankan",
      "Analisis Laporan Keuangan",
    ],
    "Prodi Manajemen": [
      "Manajemen Dasar",
      "Manajemen Sumber Daya Manusia",
      "Manajemen Operasional",
      "Manajemen Pemasaran",
      "Manajemen Keuangan",
      "Manajemen Strategik",
      "Kewirausahaan",
      "Perilaku Organisasi",
      "Manajemen Internasional",
      "Manajemen Perubahan",
    ],
    "Prodi Hukum": [
      "Pengantar Hukum Indonesia",
      "Hukum Perdata",
      "Hukum Pidana",
      "Hukum Tata Negara",
      "Hukum Administrasi Negara",
      "Hukum Internasional",
      "Hukum Bisnis",
      "Hukum Perburuhan",
      "Hukum Lingkungan",
      "Hukum Teknologi Informasi",
    ],
    "Prodi Ilmu Pemerintahan": [
      "Sistem Politik Indonesia",
      "Teori Pemerintahan",
      "Kebijakan Publik",
      "Administrasi Publik",
      "Pemerintahan Daerah",
      "Partisipasi dan Demokrasi",
      "Politik Lokal",
      "Governance",
      "Analisis Kebijakan Publik",
      "Hukum Tata Pemerintahan",
    ],
    "Ilmu Komunikasi": [
      "Pengantar Ilmu Komunikasi",
      "Teori Komunikasi",
      "Jurnalistik",
      "Public Relations",
      "Komunikasi Massa",
      "Komunikasi Organisasi",
      "Media Sosial",
      "Komunikasi Pemasaran",
      "Komunikasi Internasional",
      "Komunikasi Politik",
    ],
    "Hubungan Internasional": [
      "Pengantar Hubungan Internasional",
      "Teori Hubungan Internasional",
      "Organisasi Internasional",
      "Diplomasi",
      "Politik Global",
      "Hukum Internasional",
      "Ekonomi Politik Internasional",
      "Keamanan Internasional",
      "Studi Kawasan",
      "Negosiasi Internasional",
    ],
    "Desain Komunikasi Visual": [
      "Dasar Seni dan Desain",
      "Desain Komunikasi Visual",
      "Tipografi",
      "Ilustrasi",
      "Fotografi",
      "Desain Multimedia",
      "Animasi",
      "Branding",
      "Desain Interaksi",
      "Motion Graphics",
    ],
    "Desain Interior": [
      "Dasar Desain Interior",
      "Gambar Teknik Interior",
      "Material Bangunan",
      "Pencahayaan",
      "Akustik",
      "Furniture Design",
      "Desain Ruang Komersial",
      "Desain Ruang Hunian",
      "Desain Ruang Publik",
      "Manajemen Proyek Interior",
    ],
    "Sastra Inggris": [
      "Reading Comprehension",
      "Writing Skills",
      "Listening Skills",
      "Speaking Skills",
      "Grammar",
      "Introduction to Literature",
      "American Literature",
      "British Literature",
      "Translation",
      "Cross-Cultural Understanding",
    ],
    "Sastra Jepang": [
      "Bahasa Jepang Dasar",
      "Kanji Dasar",
      "Percakapan Bahasa Jepang",
      "Tata Bahasa Jepang",
      "Budaya Jepang",
      "Sastra Jepang",
      "Sejarah Jepang",
      "Terjemahan Jepang-Indonesia",
      "Business Japanese",
      "Japanese Pop Culture",
    ],
    "Magister Sistem Informasi": [
      "Manajemen TI Strategis",
      "Enterprise Architecture",
      "Big Data Analytics",
      "Cloud Computing",
      "Information Security Management",
      "Business Process Management",
      "IT Governance",
      "Digital Transformation",
      "Research Methodology",
      "IT Project Management",
    ],
    "Magister Desain": [
      "Metodologi Desain",
      "Desain Strategis",
      "Desain dan Budaya",
      "Desain Eksperimental",
      "Desain dan Teknologi",
      "Desain Berkelanjutan",
      "Visual Communication",
      "Design Thinking",
      "Brand Strategy",
      "Desain dan Masyarakat",
    ],
    "Magister Manajemen": [
      "Manajemen Strategik",
      "Kepemimpinan",
      "Manajemen Perubahan",
      "Manajemen Global",
      "Manajemen Inovasi",
      "Corporate Governance",
      "Business Analytics",
      "Strategic Marketing",
      "Financial Management",
      "Human Capital Management",
    ],
    "Magister Ilmu Komunikasi": [
      "Teori Komunikasi Lanjut",
      "Metodologi Penelitian Komunikasi",
      "Media dan Masyarakat",
      "Komunikasi Organisasi",
      "Komunikasi Politik",
      "Komunikasi Pemasaran Terpadu",
      "Media Digital",
      "Komunikasi Korporat",
      "Komunikasi Antar Budaya",
      "Public Opinion",
    ],
    "Doktor Ilmu Manajemen": [
      "Filsafat Ilmu",
      "Metodologi Penelitian",
      "Teori Manajemen Kontemporer",
      "Manajemen Strategik Lanjut",
      "Manajemen Inovasi",
      "Kewirausahaan Strategik",
      "Kebijakan Bisnis",
      "Corporate Sustainability",
      "Advanced Business Analytics",
      "Manajemen Pengetahuan",
    ],
  };

  // Data dosen lengkap untuk setiap program studi
  const dosenByProdi = {
    "Prodi Teknik Informatika": [
      "Prof. Dr. Bambang Setiawan, M.Kom",
      "Dr. Andi Wijaya, M.Kom",
      "Dian Puspita, M.T.",
      "Eko Prasetyo, S.T., M.T.",
      "Fajar Nugroho, M.Kom",
    ],
    "Prodi Sistem Informasi": [
      "Dr. Budi Santoso, M.T.I",
      "Ratna Dewi, M.Sc",
      "Hendri Saputra, M.Kom",
      "Linda Wulandari, M.T.I",
    ],
    "Prodi Sistem Komputer": [
      "Dr. Hendra Wijaya, S.T., M.T.",
      "Ir. Dedy Hartono, M.T.",
      "Dr. Citra Dewi, M.T.",
      "Ahmad Fauzi, M.Kom",
    ],
    "Prodi Teknik Industri": [
      "Dr. Linda Kusuma, S.T., M.T.",
      "Prof. Dr. Widyawati, M.M.",
      "Bambang Sutrisno, M.Sc",
      "Dina Ratnasari, M.T.",
    ],
    "Prodi Teknik Elektro": [
      "Prof. Dr. Eko Prasetyo, S.T., M.T.",
      "Dr. Fitri Handayani, S.T., M.Eng.",
      "Ir. Joko Susilo, M.T.",
      "Dr. Arya Wicaksana, M.Sc",
    ],
    "Prodi Teknik Arsitektur": [
      "Ir. Bambang Sutrisno, M.Sc",
      "Dina Ratnasari, M.Ds.",
      "Agus Suherman, M.Ds.",
      "Yuki Tanaka, M.Arch",
    ],
    "Prodi Teknik Sipil": [
      "Ir. Joko Susilo, M.T.",
      "Dr. Arya Wicaksana, M.Sc",
      "Prof. Dr. H. Ahmad Sudiro, M.T.",
      "Dr. Rina Hartati, M.T.",
    ],
    "Perencanaan Wilayah dan Kota": [
      "Dr. Retno Marsudi, M.A.",
      "Dian Sastrowardoyo, M.I.Kom",
      "Budi Santoso, M.Sn",
      "Dr. Michael Tanuwijaya, M.B.A.",
    ],
    "Prodi Teknik Robotika dan Kecerdasan Buatan": [
      "Prof. Dr. Ahmad Budiman, M.T.",
      "Dr. Maya Fitriani, M.T.",
      "Dr. Wahyu Sasmita, M.T.",
      "Dr. Rina Susanti, M.T.",
    ],
    "Prodi Manajemen Informatika": [
      "Dr. Arif Nugroho, M.Si.",
      "Dewi Anggraeni, M.Kn",
      "Bambang Sulistyo, M.H.",
      "Dr. John Doe, M.Sc",
    ],
    "Komputerisasi Akuntansi": [
      "Drs. H. Ahmad Fauzi, M.Ak.",
      "Dra. Nurul Hidayati, M.Ak.",
      "Prof. Jane Smith, Ph.D",
      "Dr. Jane Doe, M.Acc",
    ],
    "Keuangan dan Perbankan": [
      "Dr. Rina Setiawan, S.E., M.M.",
      "Prof. Dr. H. Muhammad Ali, M.B.A., Ph.D",
      "Dr. Michael Tanuwijaya, M.B.A.",
      "Dr. Linda Kusuma, M.M.",
    ],
    "Manajemen Pemasaran": [
      "Dian Sastrowardoyo, M.I.Kom",
      "Dr. Retno Marsudi, M.A.",
      "Budi Santoso, M.Sn",
      "Dr. Arya Wicaksana, M.Sc",
    ],
    "Desain Grafis": [
      "Budi Santoso, M.Sn",
      "Agus Suherman, M.Ds.",
      "Dina Ratnasari, M.Ds.",
      "Yuki Tanaka, M.Ds.",
    ],
    "Prodi Akuntansi": [
      "Dra. Nurul Hidayati, M.Ak.",
      "Drs. H. Ahmad Fauzi, M.Ak.",
      "Prof. Dr. Widyawati, M.M.",
      "Dr. Jane Doe, M.Acc",
    ],
    "Prodi Manajemen": [
      "Prof. Dr. Widyawati, M.M.",
      "Dr. Michael Tanuwijaya, M.B.A.",
      "Prof. Dr. H. Muhammad Ali, M.B.A., Ph.D",
      "Dr. Linda Kusuma, M.M.",
    ],
    "Prodi Hukum": [
      "Prof. Dr. H. Ahmad Sudiro, S.H., M.H.",
      "Dr. Rina Hartati, S.H., LL.M.",
      "Bambang Sulistyo, S.H., M.H.",
      "Dewi Anggraeni, S.H., M.Kn",
    ],
    "Prodi Ilmu Pemerintahan": [
      "Dr. Retno Marsudi, M.A.",
      "Dian Sastrowardoyo, M.I.Kom",
      "Dr. Arif Nugroho, M.Si.",
      "Dr. Arya Wicaksana, M.Sc",
    ],
    "Ilmu Komunikasi": [
      "Dian Sastrowardoyo, M.I.Kom",
      "Dr. Arif Nugroho, M.Si.",
      "Budi Santoso, M.I.Kom",
      "Agus Suherman, M.I.Kom",
    ],
    "Hubungan Internasional": [
      "Dr. Retno Marsudi, M.A.",
      "Prof. Dr. H. Ahmad Sudiro, M.A.",
      "Dr. Arya Wicaksana, M.A.",
      "Dian Sastrowardoyo, M.A.",
    ],
    "Desain Komunikasi Visual": [
      "Budi Santoso, M.Sn",
      "Agus Suherman, M.Ds.",
      "Dina Ratnasari, M.Ds.",
      "Yuki Tanaka, M.Ds.",
    ],
    "Desain Interior": [
      "Dina Ratnasari, M.Ds.",
      "Agus Suherman, M.Ds.",
      "Yuki Tanaka, M.Ds.",
      "Budi Santoso, M.Ds.",
    ],
    "Sastra Inggris": [
      "Yuki Tanaka, S.S., M.Hum",
      "Prof. Dr. H. Ahmad Sudiro, M.Hum",
      "Dr. Rina Hartati, M.Hum",
      "Dian Sastrowardoyo, M.Hum",
    ],
    "Sastra Jepang": [
      "Yuki Tanaka, S.S., M.Hum",
      "Prof. Dr. H. Ahmad Sudiro, M.Hum",
      "Dr. Rina Hartati, M.Hum",
      "Dian Sastrowardoyo, M.Hum",
    ],
    "Magister Sistem Informasi": [
      "Prof. Dr. Bambang Setiawan, M.Kom",
      "Dr. Andi Wijaya, M.Kom",
      "Dr. Budi Santoso, M.T.I",
      "Dr. Hendra Wijaya, M.T.",
    ],
    "Magister Desain": [
      "Budi Santoso, M.Sn",
      "Agus Suherman, M.Ds.",
      "Dina Ratnasari, M.Ds.",
      "Yuki Tanaka, M.Ds.",
    ],
    "Magister Manajemen": [
      "Prof. Dr. Widyawati, M.M.",
      "Dr. Michael Tanuwijaya, M.B.A.",
      "Prof. Dr. H. Muhammad Ali, M.B.A., Ph.D",
      "Dr. Linda Kusuma, M.M.",
    ],
    "Magister Ilmu Komunikasi": [
      "Dian Sastrowardoyo, M.I.Kom",
      "Dr. Arif Nugroho, M.Si.",
      "Budi Santoso, M.I.Kom",
      "Agus Suherman, M.I.Kom",
    ],
    "Doktor Ilmu Manajemen": [
      "Prof. Dr. H. Muhammad Ali, M.B.A., Ph.D",
      "Prof. Dr. Widyawati, Ph.D",
      "Dr. Michael Tanuwijaya, Ph.D",
      "Dr. Linda Kusuma, Ph.D",
    ],
  };

  // Generate kelas harian lengkap untuk 7 hari
  const kelasHarian = {};

  function generateAllClasses() {
    const startDate = new Date("2025-07-19");
    const days = 7; // Jumlah hari yang akan digenerate

    for (let i = 0; i < days; i++) {
      const currentDate = new Date(startDate);
      currentDate.setDate(startDate.getDate() + i);
      const dateStr = currentDate.toISOString().split("T")[0];
      const formattedDate = formatDate(currentDate);

      kelasHarian[dateStr] = {};

      for (const [prodi, matkuls] of Object.entries(prodiMatkul)) {
        kelasHarian[dateStr][prodi] = {};

        // Ambil 2-3 matkul random per hari
        const shuffled = [...matkuls].sort(() => 0.5 - Math.random());
        const selectedMatkuls = shuffled.slice(
          0,
          Math.floor(Math.random() * 2) + 2
        );

        selectedMatkuls.forEach((matkul, index) => {
          const waktuMulai = 8 + index * 3; // Jam mulai: 8, 11, 14
          const waktuSelesai = waktuMulai + 2;

          kelasHarian[dateStr][prodi][matkul] = {
            badge: generateBadge(i, index),
            title: generateClassTitle(matkul),
            date: formattedDate,
            time: `${waktuMulai.toString().padStart(2, "0")}.00 - ${waktuSelesai
              .toString()
              .padStart(2, "0")}.00`,
            dosen: generateDosen(prodi, matkul),
            ruang: generateRoom(prodi),
            metode: Math.random() > 0.5 ? "Online" : "Offline",
            link: generateClassLink(prodi, matkul),
          };
        });
      }
    }
  }

  // Helper functions
  function formatDate(date) {
    const options = { day: "numeric", month: "short", year: "numeric" };
    return date.toLocaleDateString("id-ID", options);
  }

  function formatDisplayDate(dateStr) {
    const date = new Date(dateStr);
    const options = {
      weekday: "long",
      day: "numeric",
      month: "long",
      year: "numeric",
    };
    return date.toLocaleDateString("id-ID", options);
  }

  function generateBadge(dayOffset, classIndex) {
    if (dayOffset === 0) {
      return (
        ["Baru saja", "1 Jam Lagi", "2 Jam Lagi"][classIndex] || "Hari Ini"
      );
    } else if (dayOffset === 1) {
      return "Besok";
    } else {
      return `${dayOffset} Hari Lagi`;
    }
  }

  function generateClassTitle(matkul) {
    const topics = {
      // Prodi Teknik Informatika
      "Algoritma dan Pemrograman": [
        "Pengenalan Algoritma",
        "Struktur Kontrol",
        "Fungsi dan Prosedur",
        "Rekursi",
        "Pemrograman Modular",
      ],
      "Struktur Data": [
        "Array dan Linked List",
        "Stack dan Queue",
        "Tree dan Graph",
        "Sorting dan Searching",
        "Hash Table",
      ],
      "Basis Data": [
        "Model Relasional",
        "Normalisasi Database",
        "SQL Dasar",
        "Transaction",
        "Indexing",
      ],
      "Pemrograman Berorientasi Objek": [
        "Class dan Object",
        "Inheritance",
        "Polymorphism",
        "Encapsulation",
        "Design Pattern",
      ],
      "Jaringan Komputer": [
        "Dasar Jaringan",
        "Protokol TCP/IP",
        "Network Security",
        "Wireless Network",
        "Cloud Networking",
      ],
      "Pemrograman Web": [
        "HTML5",
        "CSS3",
        "JavaScript Dasar",
        "Responsive Design",
        "Framework Frontend",
      ],
      "Sistem Operasi": [
        "Process Management",
        "Memory Management",
        "File Systems",
        "Scheduling",
        "Virtualization",
      ],
      "Kecerdasan Buatan": [
        "Search Algorithms",
        "Knowledge Representation",
        "Machine Learning",
        "Neural Network",
        "Natural Language Processing",
      ],
      "Machine Learning": [
        "Supervised Learning",
        "Unsupervised Learning",
        "Deep Learning",
        "Reinforcement Learning",
        "Model Evaluation",
      ],
      "Pengembangan Aplikasi Mobile": [
        "Android Development",
        "iOS Development",
        "Hybrid Apps",
        "Mobile UI/UX",
        "API Integration",
      ],

      // Prodi Sistem Informasi
      "Sistem Basis Data": [
        "Database Design",
        "SQL Advanced",
        "NoSQL",
        "Data Warehouse",
        "Big Data",
      ],
      "Analisis dan Desain Sistem": [
        "Requirement Analysis",
        "Use Case Diagram",
        "Class Diagram",
        "Sequence Diagram",
        "System Architecture",
      ],
      "Manajemen Proyek TI": [
        "Project Planning",
        "Risk Management",
        "Agile Methodology",
        "Scrum",
        "Project Evaluation",
      ],
      "Sistem Enterprise": [
        "ERP Systems",
        "CRM Systems",
        "SCM Systems",
        "Business Process Modeling",
        "Enterprise Architecture",
      ],
      "E-Bisnis": [
        "Digital Marketing",
        "E-Commerce Platform",
        "Payment Gateway",
        "Cyber Law",
        "Digital Transformation",
      ],
      "Interaksi Manusia-Komputer": [
        "UI/UX Principles",
        "Usability Testing",
        "User Research",
        "Prototyping",
        "Accessibility",
      ],
      "Keamanan Sistem Informasi": [
        "Cryptography",
        "Network Security",
        "Security Policy",
        "Ethical Hacking",
        "Digital Forensics",
      ],
      "Data Warehouse": [
        "ETL Process",
        "Dimensional Modeling",
        "OLAP",
        "Data Mining",
        "Business Intelligence",
      ],
      "Business Intelligence": [
        "Data Visualization",
        "Dashboard Design",
        "Predictive Analytics",
        "Decision Support System",
        "Data Storytelling",
      ],
      "Manajemen Sistem Informasi": [
        "IT Governance",
        "IT Strategy",
        "IT Service Management",
        "IT Audit",
        "Digital Leadership",
      ],

      // Prodi Sistem Komputer
      "Arsitektur Komputer": [
        "CPU Architecture",
        "Memory Hierarchy",
        "I/O Systems",
        "Parallel Processing",
        "Performance Evaluation",
      ],
      "Organisasi Komputer": [
        "Instruction Set",
        "Assembly Language",
        "Processor Design",
        "Pipeline Processing",
        "Cache Memory",
      ],
      "Sistem Digital": [
        "Logic Gates",
        "Combinational Circuits",
        "Sequential Circuits",
        "FPGA",
        "VHDL Programming",
      ],
      "Jaringan Komputer": [
        "Network Topology",
        "Routing Protocols",
        "Network Security",
        "Wireless Network",
        "Network Management",
      ],
      "Sistem Embedded": [
        "Microcontroller",
        "Real-time Systems",
        "Embedded Linux",
        "IoT Devices",
        "Firmware Development",
      ],
      Robotika: [
        "Robot Kinematics",
        "Robot Control",
        "Robot Sensors",
        "Robot Programming",
        "Autonomous Robots",
      ],
      "Internet of Things": [
        "IoT Architecture",
        "Sensor Networks",
        "MQTT Protocol",
        "Edge Computing",
        "IoT Security",
      ],
      "Sistem Tertanam Real-Time": [
        "RTOS",
        "Task Scheduling",
        "Interrupt Handling",
        "Real-time Communication",
        "Safety Critical Systems",
      ],
      "Keamanan Jaringan": [
        "Firewall",
        "Intrusion Detection",
        "VPN",
        "Penetration Testing",
        "Cyber Security",
      ],
      "Komputasi Paralel": [
        "Multi-core Programming",
        "GPU Computing",
        "Distributed Systems",
        "MapReduce",
        "Cloud Computing",
      ],

      // Prodi Teknik Industri
      "Pengantar Teknik Industri": [
        "Industrial Systems",
        "Productivity Concepts",
        "Industrial History",
        "Engineering Ethics",
        "Career Path",
      ],
      "Statistika Industri": [
        "Descriptive Statistics",
        "Probability",
        "Hypothesis Testing",
        "Regression Analysis",
        "Quality Control",
      ],
      Ergonomi: [
        "Workplace Design",
        "Human Factors",
        "Biomechanics",
        "Cognitive Ergonomics",
        "Occupational Health",
      ],
      "Manajemen Operasi": [
        "Production Planning",
        "Inventory Control",
        "Supply Chain",
        "Lean Manufacturing",
        "Six Sigma",
      ],
      "Logistik dan Rantai Pasok": [
        "Warehouse Management",
        "Transportation",
        "Procurement",
        "Demand Forecasting",
        "Global Supply Chain",
      ],
      "Perencanaan dan Pengendalian Produksi": [
        "Master Production Schedule",
        "MRP",
        "Capacity Planning",
        "Shop Floor Control",
        "JIT",
      ],
      "Sistem Manufaktur": [
        "CNC Machines",
        "Robotics in Manufacturing",
        "Additive Manufacturing",
        "Automation",
        "Industry 4.0",
      ],
      "Kualitas dan Keandalan": [
        "TQM",
        "Statistical Process Control",
        "Reliability Engineering",
        "Failure Analysis",
        "Quality Standards",
      ],
      "Simulasi Sistem": [
        "Discrete Event Simulation",
        "System Modeling",
        "Simulation Software",
        "Input Analysis",
        "Output Analysis",
      ],
      "Ekonomi Teknik": [
        "Time Value of Money",
        "Cost Analysis",
        "Investment Evaluation",
        "Depreciation",
        "Project Financing",
      ],

      // Prodi Teknik Elektro
      "Rangkaian Listrik": [
        "Hukum Ohm",
        "Rangkaian Seri-Paralel",
        "Thevenin-Norton",
        "Rangkaian AC",
        "Three-Phase System",
      ],
      "Elektronika Dasar": [
        "Dioda",
        "Transistor",
        "Op-Amp",
        "Digital Circuits",
        "PCB Design",
      ],
      "Sistem Digital": [
        "Number Systems",
        "Logic Gates",
        "Combinational Logic",
        "Sequential Logic",
        "FPGA",
      ],
      "Medan Elektromagnetik": [
        "Electrostatics",
        "Magnetostatics",
        "Maxwell Equations",
        "Wave Propagation",
        "Antenna Theory",
      ],
      "Sistem Kendali": [
        "Feedback Control",
        "PID Controller",
        "System Stability",
        "Root Locus",
        "State Space",
      ],
      Mikroprosesor: [
        "Microcontroller Architecture",
        "Assembly Programming",
        "Interfacing",
        "Embedded C",
        "RTOS",
      ],
      Telekomunikasi: [
        "Modulation Techniques",
        "Multiplexing",
        "Wireless Communication",
        "Fiber Optics",
        "5G Technology",
      ],
      "Pembangkit Tenaga Listrik": [
        "Power Plants",
        "Renewable Energy",
        "Smart Grid",
        "Energy Storage",
        "Power Distribution",
      ],
      "Instalasi Listrik": [
        "Wiring Design",
        "Electrical Safety",
        "Load Calculation",
        "Lighting System",
        "Electrical Codes",
      ],
      "Robotika Industri": [
        "Industrial Robots",
        "Robot Programming",
        "End Effectors",
        "Robot Safety",
        "Automation Systems",
      ],

      // Prodi Teknik Arsitektur
      "Dasar Perancangan Arsitektur": [
        "Prinsip Desain",
        "Elemen Arsitektur",
        "Prinsip Komposisi",
        "Sketsa Dasar",
        "Presentasi Desain",
      ],
      "Gambar Arsitektur": [
        "Teknik Menggambar",
        "Drafting Manual",
        "Notasi Arsitektur",
        "Denah-Tampak-Potongan",
        "Detail Konstruksi",
      ],
      "Sejarah Arsitektur": [
        "Arsitektur Klasik",
        "Arsitektur Modern",
        "Arsitektur Post-Modern",
        "Arsitektur Kontemporer",
        "Arsitektur Lokal",
      ],
      "Struktur Bangunan": [
        "Sistem Struktur",
        "Material Konstruksi",
        "Perilaku Struktur",
        "Struktur Bambu",
        "Struktur Inovatif",
      ],
      "Utilitas Bangunan": [
        "Sistem Plumbing",
        "Instalasi Listrik",
        "AC dan Ventilasi",
        "Sistem Transportasi Vertikal",
        "Smart Building",
      ],
      "Arsitektur Lingkungan": [
        "Desain Iklim Tropis",
        "Energi Efisien",
        "Material Berkelanjutan",
        "Biophilic Design",
        "Arsitektur Hijau",
      ],
      "Perancangan Kota": [
        "Urban Design",
        "Zoning Regulation",
        "Public Space",
        "Transit Oriented Development",
        "Kota Berkelanjutan",
      ],
      "Arsitektur Interior": [
        "Prinsip Desain Interior",
        "Material Interior",
        "Furniture Design",
        "Lighting Design",
        "Interior Komersial",
      ],
      "Teknologi Bangunan": [
        "BIM",
        "Parametric Design",
        "3D Printing",
        "Prefabrikasi",
        "Teknologi Konstruksi",
      ],
      "Arsitektur Tropis": [
        "Adaptasi Iklim",
        "Passive Cooling",
        "Atap dan Kanopi",
        "Ventilasi Alami",
        "Material Lokal",
      ],

      // Prodi Teknik Sipil
      "Mekanika Teknik": [
        "Statika Struktur",
        "Analisis Gaya",
        "Momen dan Geser",
        "Keseimbangan",
        "Struktur Rangka",
      ],
      "Struktur Beton": [
        "Material Beton",
        "Perencanaan Balok",
        "Perencanaan Kolom",
        "Pelat Lantai",
        "Struktur Bertulang",
      ],
      "Struktur Baja": [
        "Profil Baja",
        "Sambungan Baja",
        "Struktur Rangka Baja",
        "Tower dan Jembatan",
        "Fire Protection",
      ],
      "Mekanika Tanah": [
        "Sifat Tanah",
        "Klasifikasi Tanah",
        "Kuat Geser Tanah",
        "Konsolidasi",
        "Stabilitas Lereng",
      ],
      "Teknik Pondasi": [
        "Pondasi Dangkal",
        "Pondasi Dalam",
        "Daya Dukung Tanah",
        "Settlement Analysis",
        "Pondasi Khusus",
      ],
      "Manajemen Konstruksi": [
        "Project Planning",
        "Cost Estimation",
        "Construction Method",
        "Quality Control",
        "Safety Management",
      ],
      Hidrologi: [
        "Siklus Hidrologi",
        "Analisis Curah Hujan",
        "Aliran Sungai",
        "Drainase Perkotaan",
        "Flood Control",
      ],
      Transportasi: [
        "Perencanaan Transportasi",
        "Geometrik Jalan",
        "Pembangunan Jalan",
        "Lalu Lintas",
        "Public Transport",
      ],
      "Teknik Lingkungan": [
        "Pengolahan Air",
        "Pengelolaan Sampah",
        "Sanitasi Lingkungan",
        "AMDAL",
        "Teknik Penyehatan",
      ],
      "Perencanaan Wilayah": [
        "Tata Ruang",
        "Regional Planning",
        "Infrastruktur Wilayah",
        "Pembangunan Berkelanjutan",
        "GIS untuk Perencanaan",
      ],

      // Perencanaan Wilayah dan Kota
      "Dasar Perencanaan": [
        "Teori Perencanaan",
        "Sejarah Perkotaan",
        "Sistem Kota",
        "Proses Perencanaan",
        "Peran Planner",
      ],
      "Tata Ruang Kota": [
        "Zoning Regulation",
        "Land Use Planning",
        "Urban Form",
        "Density Control",
        "Mixed-Use Development",
      ],
      "Transportasi Perkotaan": [
        "Transport Planning",
        "Public Transit",
        "Non-Motorized Transport",
        "Parking Management",
        "Smart Mobility",
      ],
      "Perencanaan Wilayah": [
        "Regional Development",
        "Rural Planning",
        "Metropolitan Planning",
        "Border Area Planning",
        "Island Planning",
      ],
      "Sistem Informasi Geografis": [
        "Pemetaan Digital",
        "Spatial Analysis",
        "Remote Sensing",
        "Urban Modeling",
        "GIS Applications",
      ],
      "Perencanaan Infrastruktur": [
        "Utility Planning",
        "Water Supply System",
        "Waste Management",
        "Energy Infrastructure",
        "ICT Infrastructure",
      ],
      "Ekonomi Perkotaan": [
        "Urban Economics",
        "Property Market",
        "Creative Economy",
        "Tourism Development",
        "Urban Regeneration",
      ],
      "Perencanaan Lingkungan": [
        "Environmental Planning",
        "Climate Change Adaptation",
        "Disaster Mitigation",
        "Green Infrastructure",
        "Ecological Planning",
      ],
      "Perencanaan Pariwisata": [
        "Tourism Planning",
        "Heritage Conservation",
        "Ecotourism",
        "Sustainable Tourism",
        "Tourism Infrastructure",
      ],
      "Kebijakan Pembangunan": [
        "Development Policy",
        "Public Participation",
        "Spatial Governance",
        "Planning Law",
        "Development Evaluation",
      ],

      // Prodi Teknik Robotika dan Kecerdasan Buatan
      "Dasar Robotika": [
        "Sejarah Robotika",
        "Komponen Robot",
        "Kinematika Dasar",
        "Sensor dan Aktuator",
        "Robotika Modern",
      ],
      "Pemrograman Robot": [
        "Robot Operating System",
        "Motion Planning",
        "Path Planning",
        "Robot Simulation",
        "Human-Robot Interaction",
      ],
      "Sistem Sensor dan Aktuator": [
        "Jenis Sensor",
        "Vision System",
        "Force/Torque Sensor",
        "Motor dan Servo",
        "End Effectors",
      ],
      "Kecerdasan Buatan untuk Robot": [
        "Machine Learning untuk Robot",
        "Computer Vision",
        "Natural Language Processing",
        "Reinforcement Learning",
        "Swarm Intelligence",
      ],
      "Computer Vision": [
        "Image Processing",
        "Object Detection",
        "Face Recognition",
        "3D Vision",
        "Deep Learning Vision",
      ],
      "Machine Learning": [
        "Supervised Learning",
        "Unsupervised Learning",
        "Neural Networks",
        "Deep Learning",
        "Model Deployment",
      ],
      "Robotika Industri": [
        "Industrial Automation",
        "Robotic Arm",
        "Assembly Line",
        "Quality Inspection",
        "Collaborative Robots",
      ],
      "Robotika Cerdas": [
        "Autonomous Navigation",
        "SLAM",
        "Decision Making",
        "Multi-Robot Systems",
        "AI Ethics",
      ],
      "Sistem Otonom": [
        "Self-Driving Cars",
        "Drones",
        "Autonomous Mobile Robots",
        "AI Planning",
        "Real-time Systems",
      ],
      "Proyek Robotika": [
        "Robot Design",
        "System Integration",
        "Testing and Validation",
        "Project Management",
        "Capstone Project",
      ],

      // Prodi Manajemen Informatika
      "Pemrograman Dasar": [
        "Algoritma",
        "Struktur Data",
        "Python Programming",
        "Debugging",
        "Problem Solving",
      ],
      "Manajemen Database": [
        "Database Design",
        "SQL Programming",
        "NoSQL Database",
        "Database Security",
        "Big Data",
      ],
      "Sistem Informasi Manajemen": [
        "Business Process",
        "Information System",
        "Decision Support System",
        "Enterprise System",
        "Digital Transformation",
      ],
      "Pemrograman Bisnis": [
        "Business Logic",
        "ERP Systems",
        "CRM Development",
        "Financial Software",
        "Inventory System",
      ],
      "Jaringan Komputer": [
        "Network Basics",
        "Network Security",
        "Cloud Computing",
        "Wireless Network",
        "Network Management",
      ],
      "Keamanan Sistem": [
        "Cyber Security",
        "Ethical Hacking",
        "Cryptography",
        "Security Policy",
        "Digital Forensics",
      ],
      "Analisis Bisnis": [
        "Requirement Analysis",
        "Business Modeling",
        "Process Improvement",
        "Data Analysis",
        "Business Intelligence",
      ],
      "Manajemen Proyek TI": [
        "Project Life Cycle",
        "Agile Methodology",
        "Risk Management",
        "Quality Assurance",
        "Project Documentation",
      ],
      "E-Commerce": [
        "Online Marketplace",
        "Payment Gateway",
        "Digital Marketing",
        "Customer Experience",
        "E-Commerce Analytics",
      ],
      "Sistem Pendukung Keputusan": [
        "Data Mining",
        "Decision Tree",
        "Expert System",
        "Predictive Analytics",
        "Dashboard Design",
      ],

      // Komputerisasi Akuntansi
      "Akuntansi Keuangan": [
        "Financial Statement",
        "Accounting Cycle",
        "Asset Accounting",
        "Liability Accounting",
        "Equity Accounting",
      ],
      "Akuntansi Biaya": [
        "Cost Classification",
        "Job Order Costing",
        "Process Costing",
        "Cost Allocation",
        "Budgeting",
      ],
      "Sistem Informasi Akuntansi": [
        "Accounting Software",
        "ERP Accounting",
        "Internal Control",
        "Audit Trail",
        "Financial Reporting",
      ],
      "Audit Sistem Informasi": [
        "IT Audit",
        "Control Testing",
        "Risk Assessment",
        "Compliance Audit",
        "Audit Report",
      ],
      "Perpajakan Digital": [
        "E-Filing",
        "Tax Calculation",
        "Tax Regulation",
        "Tax Planning",
        "International Taxation",
      ],
      "Penganggaran Perusahaan": [
        "Budget Preparation",
        "Variance Analysis",
        "Capital Budgeting",
        "Cash Flow Management",
        "Financial Planning",
      ],
      "Manajemen Keuangan": [
        "Financial Analysis",
        "Investment Decision",
        "Working Capital",
        "Risk Management",
        "Corporate Finance",
      ],
      "Software Akuntansi": [
        "QuickBooks",
        "MYOB",
        "SAP FICO",
        "Oracle Financial",
        "Zoho Books",
      ],
      "Analisis Laporan Keuangan": [
        "Ratio Analysis",
        "Trend Analysis",
        "Cash Flow Analysis",
        "Valuation",
        "Investment Analysis",
      ],
      "Blockchain untuk Akuntansi": [
        "Distributed Ledger",
        "Smart Contract",
        "Crypto Accounting",
        "Audit Blockchain",
        "Regulatory Aspect",
      ],

      // Keuangan dan Perbankan
      "Manajemen Keuangan": [
        "Financial Planning",
        "Capital Structure",
        "Investment Analysis",
        "Risk Management",
        "Corporate Valuation",
      ],
      "Akuntansi Bank": [
        "Bank Accounting",
        "Loan Accounting",
        "Deposit Accounting",
        "Fee-Based Income",
        "Financial Reporting",
      ],
      "Manajemen Risiko Bank": [
        "Credit Risk",
        "Market Risk",
        "Operational Risk",
        "Risk Measurement",
        "Basel Accord",
      ],
      "Perbankan Syariah": [
        "Prinsip Syariah",
        "Mudharabah-Musharakah",
        "Islamic Bonds",
        "Islamic Insurance",
        "Sharia Compliance",
      ],
      "Investasi dan Portofolio": [
        "Security Analysis",
        "Portfolio Theory",
        "Asset Allocation",
        "Investment Strategy",
        "Performance Evaluation",
      ],
      "Pasar Modal": [
        "Stock Market",
        "Bond Market",
        "Derivatives",
        "IPO",
        "Market Regulation",
      ],
      "Manajemen Kredit": [
        "Credit Analysis",
        "Loan Structuring",
        "Credit Scoring",
        "Non-Performing Loan",
        "Debt Restructuring",
      ],
      Fintech: [
        "Digital Banking",
        "Payment System",
        "Peer-to-Peer Lending",
        "Robo-Advisor",
        "Regulatory Technology",
      ],
      "Analisis Laporan Keuangan": [
        "Bank Performance",
        "CAMELS Rating",
        "Financial Ratio",
        "Stress Testing",
        "Bank Valuation",
      ],
      "Perencanaan Keuangan": [
        "Personal Finance",
        "Retirement Planning",
        "Tax Planning",
        "Estate Planning",
        "Financial Advisory",
      ],

      // Manajemen Pemasaran
      "Dasar Pemasaran": [
        "Marketing Concept",
        "Marketing Mix",
        "Consumer Behavior",
        "Market Segmentation",
        "Positioning Strategy",
      ],
      "Perilaku Konsumen": [
        "Consumer Psychology",
        "Decision Process",
        "Cultural Influence",
        "Online Behavior",
        "Customer Journey",
      ],
      "Manajemen Pemasaran Strategik": [
        "SWOT Analysis",
        "Competitive Advantage",
        "Marketing Plan",
        "Implementation",
        "Performance Control",
      ],
      "Pemasaran Digital": [
        "Social Media Marketing",
        "Content Marketing",
        "SEO/SEM",
        "Email Marketing",
        "Influencer Marketing",
      ],
      "Manajemen Merek": [
        "Brand Identity",
        "Brand Positioning",
        "Brand Equity",
        "Brand Extension",
        "Global Branding",
      ],
      "Komunikasi Pemasaran": [
        "Advertising",
        "Public Relations",
        "Sales Promotion",
        "Direct Marketing",
        "Integrated Marketing",
      ],
      "Pemasaran Internasional": [
        "Global Market",
        "Export Strategy",
        "Cultural Adaptation",
        "International Pricing",
        "Global Distribution",
      ],
      "Riset Pemasaran": [
        "Market Research",
        "Data Collection",
        "Data Analysis",
        "Consumer Insight",
        "Research Report",
      ],
      "Manajemen Ritel": [
        "Retail Strategy",
        "Store Layout",
        "Merchandising",
        "Customer Service",
        "Omnichannel Retail",
      ],
      "E-Commerce": [
        "Online Store",
        "Marketplace",
        "Digital Payment",
        "Logistics",
        "Customer Experience",
      ],

      // Desain Grafis
      "Dasar Desain Grafis": [
        "Prinsip Desain",
        "Element of Design",
        "Design Theory",
        "Creative Process",
        "Design History",
      ],
      Tipografi: [
        "Type Anatomy",
        "Font Classification",
        "Hierarchy",
        "Pairing Fonts",
        "Experimental Typography",
      ],
      "Desain Logo": [
        "Brand Identity",
        "Logo Design Process",
        "Symbol Design",
        "Wordmark",
        "Logo Application",
      ],
      "Desain Poster": [
        "Layout Composition",
        "Visual Hierarchy",
        "Color Scheme",
        "Poster Series",
        "Print Preparation",
      ],
      "Fotografi Digital": [
        "Camera Setting",
        "Lighting Technique",
        "Composition",
        "Photo Editing",
        "Digital Imaging",
      ],
      "Ilustrasi Digital": [
        "Digital Drawing",
        "Vector Illustration",
        "Character Design",
        "Digital Painting",
        "Illustration Style",
      ],
      "Animasi 2D": [
        "Principles of Animation",
        "Storyboarding",
        "Character Animation",
        "Motion Graphics",
        "Animation Software",
      ],
      "Desain Kemasan": [
        "Structural Design",
        "Material Knowledge",
        "Label Design",
        "Sustainable Packaging",
        "3D Mockup",
      ],
      "User Interface Design": [
        "UX Principles",
        "Wireframing",
        "Prototyping",
        "Mobile UI",
        "Design System",
      ],
      "Desain Editorial": [
        "Magazine Layout",
        "Book Design",
        "Grid System",
        "Publication Design",
        "Digital Publishing",
      ],

      // Prodi Akuntansi
      "Akuntansi Keuangan": [
        "Financial Reporting",
        "Accounting Standard",
        "Asset Accounting",
        "Liability Accounting",
        "Equity Accounting",
      ],
      "Akuntansi Biaya": [
        "Cost Behavior",
        "Cost-Volume-Profit",
        "Budgeting",
        "Standard Costing",
        "Performance Measurement",
      ],
      "Akuntansi Manajemen": [
        "Decision Making",
        "Relevant Costing",
        "Capital Budgeting",
        "Transfer Pricing",
        "Balanced Scorecard",
      ],
      Auditing: [
        "Audit Evidence",
        "Internal Control",
        "Audit Sampling",
        "Audit Report",
        "Professional Ethics",
      ],
      Perpajakan: [
        "Tax Calculation",
        "Tax Planning",
        "Tax Objection",
        "International Taxation",
        "Tax Reform",
      ],
      "Sistem Informasi Akuntansi": [
        "Accounting Cycle",
        "Internal Control",
        "ERP System",
        "Database Concept",
        "IT Audit",
      ],
      "Akuntansi Sektor Publik": [
        "Government Accounting",
        "Budget Accounting",
        "Performance Audit",
        "Public Sector Reporting",
        "Fund Accounting",
      ],
      "Akuntansi Internasional": [
        "IFRS",
        "Comparative Accounting",
        "Harmonization",
        "Foreign Currency",
        "Multinational Accounting",
      ],
      "Akuntansi Perbankan": [
        "Bank Transaction",
        "Loan Accounting",
        "Deposit Accounting",
        "Fee Income",
        "Bank Reconciliation",
      ],
      "Analisis Laporan Keuangan": [
        "Ratio Analysis",
        "Cash Flow Analysis",
        "Credit Analysis",
        "Investment Analysis",
        "Valuation",
      ],

      // Prodi Manajemen
      "Manajemen Dasar": [
        "Management Theory",
        "Management Function",
        "Managerial Role",
        "Business Ethics",
        "Corporate Social Responsibility",
      ],
      "Manajemen Sumber Daya Manusia": [
        "Recruitment",
        "Training & Development",
        "Performance Appraisal",
        "Compensation",
        "Industrial Relation",
      ],
      "Manajemen Operasional": [
        "Production System",
        "Quality Management",
        "Supply Chain",
        "Inventory Control",
        "Lean Management",
      ],
      "Manajemen Pemasaran": [
        "Marketing Mix",
        "Consumer Behavior",
        "Brand Management",
        "Digital Marketing",
        "Marketing Strategy",
      ],
      "Manajemen Keuangan": [
        "Financial Analysis",
        "Capital Budgeting",
        "Working Capital",
        "Risk Management",
        "Corporate Finance",
      ],
      "Manajemen Strategik": [
        "Strategic Analysis",
        "Competitive Advantage",
        "Corporate Strategy",
        "Strategy Implementation",
        "Performance Evaluation",
      ],
      Kewirausahaan: [
        "Business Idea",
        "Business Model",
        "Startup Funding",
        "Business Plan",
        "Growth Strategy",
      ],
      "Perilaku Organisasi": [
        "Organizational Culture",
        "Leadership Style",
        "Motivation Theory",
        "Team Dynamics",
        "Organizational Change",
      ],
      "Manajemen Internasional": [
        "Global Business",
        "Cross-Cultural Management",
        "Export-Import",
        "Foreign Investment",
        "Global Strategy",
      ],
      "Manajemen Perubahan": [
        "Change Model",
        "Change Resistance",
        "Change Communication",
        "Change Implementation",
        "Change Evaluation",
      ],

      // Prodi Hukum
      "Pengantar Hukum Indonesia": [
        "Legal System",
        "Law Source",
        "Legal Institution",
        "Law Profession",
        "Legal Education",
      ],
      "Hukum Perdata": [
        "Contract Law",
        "Property Law",
        "Family Law",
        "Inheritance Law",
        "Tort Law",
      ],
      "Hukum Pidana": [
        "Criminal Act",
        "Criminal Liability",
        "Penal Sanction",
        "Criminal Procedure",
        "Special Criminal Law",
      ],
      "Hukum Tata Negara": [
        "State Theory",
        "Constitution",
        "State Institution",
        "Human Rights",
        "Constitutional Court",
      ],
      "Hukum Administrasi Negara": [
        "Government Authority",
        "Administrative Decision",
        "Public Service",
        "Administrative Court",
        "State Administrative Law",
      ],
      "Hukum Internasional": [
        "International Treaty",
        "Diplomatic Law",
        "International Organization",
        "Humanitarian Law",
        "Dispute Settlement",
      ],
      "Hukum Bisnis": [
        "Company Law",
        "Capital Market Law",
        "Banking Law",
        "Bankruptcy Law",
        "Business Contract",
      ],
      "Hukum Perburuhan": [
        "Employment Contract",
        "Labor Union",
        "Industrial Dispute",
        "Social Security",
        "Labor Court",
      ],
      "Hukum Lingkungan": [
        "Environmental Principle",
        "Environmental Crime",
        "AMDAL",
        "Climate Change Law",
        "Sustainable Development",
      ],
      "Hukum Teknologi Informasi": [
        "Cyber Law",
        "Digital Contract",
        "Data Protection",
        "E-Commerce Law",
        "Intellectual Property",
      ],

      // Prodi Ilmu Pemerintahan
      "Sistem Politik Indonesia": [
        "Political History",
        "Political Party",
        "Election System",
        "Political Culture",
        "Decentralization",
      ],
      "Teori Pemerintahan": [
        "Government Theory",
        "State Concept",
        "Governance",
        "Public Policy",
        "Bureaucracy",
      ],
      "Kebijakan Publik": [
        "Policy Process",
        "Policy Analysis",
        "Policy Implementation",
        "Policy Evaluation",
        "Public Participation",
      ],
      "Administrasi Publik": [
        "Public Organization",
        "Public Service",
        "Bureaucratic Reform",
        "Performance Measurement",
        "E-Government",
      ],
      "Pemerintahan Daerah": [
        "Local Autonomy",
        "Regional Development",
        "Local Politics",
        "Village Government",
        "Intergovernmental Relation",
      ],
      "Partisipasi dan Demokrasi": [
        "Civil Society",
        "Public Opinion",
        "Community Empowerment",
        "Social Movement",
        "Democratic Consolidation",
      ],
      "Politik Lokal": [
        "Local Elite",
        "Political Dynasty",
        "Money Politics",
        "Local Election",
        "Political Network",
      ],
      Governance: [
        "Good Governance",
        "Corporate Governance",
        "Network Governance",
        "Global Governance",
        "Smart Governance",
      ],
      "Analisis Kebijakan Publik": [
        "Policy Model",
        "Stakeholder Analysis",
        "Cost-Benefit Analysis",
        "Policy Advocacy",
        "Policy Innovation",
      ],
      "Hukum Tata Pemerintahan": [
        "Administrative Law",
        "Government Authority",
        "Public Service Law",
        "Administrative Court",
        "State Liability",
      ],

      // Ilmu Komunikasi
      "Pengantar Ilmu Komunikasi": [
        "Communication Model",
        "Communication Theory",
        "Communication Process",
        "Communication Context",
        "Communication Ethics",
      ],
      "Teori Komunikasi": [
        "Mass Communication",
        "Interpersonal Communication",
        "Organizational Communication",
        "Intercultural Communication",
        "Communication Paradigm",
      ],
      Jurnalistik: [
        "News Writing",
        "Investigative Reporting",
        "Journalistic Ethics",
        "Media Law",
        "Digital Journalism",
      ],
      "Public Relations": [
        "PR Strategy",
        "Media Relations",
        "Crisis Communication",
        "Corporate Communication",
        "PR Campaign",
      ],
      "Komunikasi Massa": [
        "Media Effect",
        "Media Literacy",
        "Media Criticism",
        "Popular Culture",
        "Mass Media Industry",
      ],
      "Komunikasi Organisasi": [
        "Organizational Culture",
        "Leadership Communication",
        "Conflict Management",
        "Internal Communication",
        "Change Communication",
      ],
      "Media Sosial": [
        "Social Media Strategy",
        "Content Creation",
        "Community Management",
        "Social Media Analytics",
        "Digital Influence",
      ],
      "Komunikasi Pemasaran": [
        "Integrated Marketing",
        "Advertising",
        "Brand Communication",
        "Consumer Insight",
        "Digital Marketing",
      ],
      "Komunikasi Internasional": [
        "Global Communication",
        "Diplomatic Communication",
        "Cross-Cultural Communication",
        "International Media",
        "Public Diplomacy",
      ],
      "Komunikasi Politik": [
        "Political Campaign",
        "Political Advertising",
        "Political Debate",
        "Political Branding",
        "Election Communication",
      ],

      // Hubungan Internasional
      "Pengantar Hubungan Internasional": [
        "International System",
        "International Relation Theory",
        "State Sovereignty",
        "Power in IR",
        "Diplomatic Practice",
      ],
      "Teori Hubungan Internasional": [
        "Realism",
        "Liberalism",
        "Constructivism",
        "Marxism",
        "Critical Theory",
      ],
      "Organisasi Internasional": [
        "United Nations",
        "ASEAN",
        "World Bank",
        "WTO",
        "NGO International",
      ],
      Diplomasi: [
        "Diplomatic Protocol",
        "Negotiation",
        "Public Diplomacy",
        "Economic Diplomacy",
        "Digital Diplomacy",
      ],
      "Politik Global": [
        "Global Governance",
        "International Security",
        "Global Political Economy",
        "Human Rights",
        "Environmental Politics",
      ],
      "Hukum Internasional": [
        "International Treaty",
        "State Responsibility",
        "International Court",
        "Humanitarian Law",
        "Law of the Sea",
      ],
      "Ekonomi Politik Internasional": [
        "Trade Politics",
        "Financial System",
        "Development Aid",
        "Multinational Corporation",
        "Global Inequality",
      ],
      "Keamanan Internasional": [
        "Traditional Security",
        "Human Security",
        "Nuclear Proliferation",
        "Terrorism",
        "Cyber Security",
      ],
      "Studi Kawasan": [
        "Asian Studies",
        "European Studies",
        "American Studies",
        "Middle East Studies",
        "African Studies",
      ],
      "Negosiasi Internasional": [
        "Negotiation Theory",
        "Bargaining Strategy",
        "Conflict Resolution",
        "Mediation",
        "Track II Diplomacy",
      ],

      // Desain Komunikasi Visual
      "Dasar Seni dan Desain": [
        "Art Principle",
        "Design Element",
        "Color Theory",
        "Composition",
        "Creative Thinking",
      ],
      "Desain Komunikasi Visual": [
        "Visual Communication",
        "Semiotics",
        "Visual Hierarchy",
        "Information Design",
        "Design Context",
      ],
      Tipografi: [
        "Type Classification",
        "Typography System",
        "Experimental Typography",
        "Type in Motion",
        "Typography in Branding",
      ],
      Ilustrasi: [
        "Drawing Technique",
        "Digital Illustration",
        "Editorial Illustration",
        "Character Design",
        "Illustration Style",
      ],
      Fotografi: [
        "Camera Technique",
        "Lighting Setup",
        "Photo Composition",
        "Photo Editing",
        "Conceptual Photography",
      ],
      "Desain Multimedia": [
        "Interactive Design",
        "Motion Graphic",
        "Video Editing",
        "Sound Design",
        "Multimedia Project",
      ],
      Animasi: [
        "Animation Principle",
        "2D Animation",
        "3D Modeling",
        "Character Animation",
        "Animation Production",
      ],
      Branding: [
        "Brand Strategy",
        "Brand Identity",
        "Logo Design",
        "Brand Application",
        "Brand Experience",
      ],
      "Desain Interaksi": [
        "User Experience",
        "Interface Design",
        "Prototyping",
        "Usability Testing",
        "Design Thinking",
      ],
      "Motion Graphics": [
        "Motion Principle",
        "Typography Animation",
        "Info Motion",
        "Broadcast Design",
        "3D Motion",
      ],

      // Desain Interior
      "Dasar Desain Interior": [
        "Space Concept",
        "Design Principle",
        "Human Scale",
        "Interior Style",
        "Design Process",
      ],
      "Gambar Teknik Interior": [
        "Technical Drawing",
        "Perspective Drawing",
        "Working Drawing",
        "3D Visualization",
        "Presentation Technique",
      ],
      "Material Bangunan": [
        "Material Property",
        "Wall Material",
        "Flooring Material",
        "Ceiling Material",
        "Sustainable Material",
      ],
      Pencahayaan: [
        "Lighting Principle",
        "Natural Lighting",
        "Artificial Lighting",
        "Lighting Fixture",
        "Lighting Design",
      ],
      Akustik: [
        "Sound Principle",
        "Noise Control",
        "Room Acoustics",
        "Sound System",
        "Acoustic Material",
      ],
      "Furniture Design": [
        "Furniture History",
        "Furniture Style",
        "Furniture Construction",
        "Custom Furniture",
        "Ergonomic Furniture",
      ],
      "Desain Ruang Komersial": [
        "Retail Design",
        "Hospitality Design",
        "Office Design",
        "Exhibition Design",
        "Commercial Space Planning",
      ],
      "Desain Ruang Hunian": [
        "Residential Space",
        "Living Room Design",
        "Kitchen Design",
        "Bedroom Design",
        "Small Space Solution",
      ],
      "Desain Ruang Publik": [
        "Public Space",
        "Community Space",
        "Cultural Space",
        "Institutional Design",
        "Universal Design",
      ],
      "Manajemen Proyek Interior": [
        "Project Planning",
        "Cost Estimation",
        "Contract Document",
        "Site Supervision",
        "Project Handover",
      ],

      // Sastra Inggris
      "Reading Comprehension": [
        "Reading Strategy",
        "Text Analysis",
        "Critical Reading",
        "Academic Reading",
        "Literature Appreciation",
      ],
      "Writing Skills": [
        "Essay Writing",
        "Academic Writing",
        "Creative Writing",
        "Business Writing",
        "Editing and Proofreading",
      ],
      "Listening Skills": [
        "Listening Strategy",
        "Note Taking",
        "Academic Listening",
        "Media Listening",
        "Accent Recognition",
      ],
      "Speaking Skills": [
        "Pronunciation",
        "Conversation Skill",
        "Public Speaking",
        "Debate",
        "Presentation Skill",
      ],
      Grammar: [
        "Sentence Structure",
        "Tense System",
        "Modifier",
        "Clause Analysis",
        "Advanced Grammar",
      ],
      "Introduction to Literature": [
        "Literary Genre",
        "Poetry Analysis",
        "Drama Analysis",
        "Prose Analysis",
        "Literary Criticism",
      ],
      "American Literature": [
        "Colonial Period",
        "Romanticism",
        "Realism",
        "Modernism",
        "Contemporary Literature",
      ],
      "British Literature": [
        "Medieval Literature",
        "Renaissance",
        "Neoclassicism",
        "Victorian Literature",
        "Modern British Literature",
      ],
      Translation: [
        "Translation Theory",
        "Translation Technique",
        "Literary Translation",
        "Technical Translation",
        "Translation Technology",
      ],
      "Cross-Cultural Understanding": [
        "Cultural Value",
        "Cultural Dimension",
        "Intercultural Communication",
        "Cultural Adaptation",
        "Global Citizenship",
      ],

      // Sastra Jepang
      "Bahasa Jepang Dasar": [
        "Hiragana-Katakana",
        "Basic Grammar",
        "Daily Conversation",
        "Japanese Culture",
        "Language Etiquette",
      ],
      "Kanji Dasar": [
        "Kanji Structure",
        "Radical System",
        "Kanji Writing",
        "Basic Kanji",
        "Kanji Compound",
      ],
      "Percakapan Bahasa Jepang": [
        "Greeting",
        "Self-Introduction",
        "Daily Expression",
        "Situation Dialogue",
        "Speech Level",
      ],
      "Tata Bahasa Jepang": [
        "Sentence Pattern",
        "Particle Usage",
        "Verb Conjugation",
        "Adjective Form",
        "Complex Sentence",
      ],
      "Budaya Jepang": [
        "Traditional Culture",
        "Modern Culture",
        "Festival",
        "Japanese Art",
        "Social Norm",
      ],
      "Sastra Jepang": [
        "Classical Literature",
        "Modern Literature",
        "Haiku Poetry",
        "Japanese Novel",
        "Literary Analysis",
      ],
      "Sejarah Jepang": [
        "Ancient Japan",
        "Feudal Period",
        "Meiji Restoration",
        "World War II",
        "Modern Japan",
      ],
      "Terjemahan Jepang-Indonesia": [
        "Translation Technique",
        "Text Analysis",
        "Cultural Adaptation",
        "Specialized Translation",
        "Translation Project",
      ],
      "Business Japanese": [
        "Business Etiquette",
        "Keigo",
        "Business Correspondence",
        "Meeting Practice",
        "Job Interview",
      ],
      "Japanese Pop Culture": [
        "Anime",
        "Manga",
        "J-Pop",
        "Japanese Film",
        "Pop Culture Analysis",
      ],

      // Magister Sistem Informasi
      "Manajemen TI Strategis": [
        "IT Governance",
        "IT Alignment",
        "IT Value",
        "IT Investment",
        "Digital Leadership",
      ],
      "Enterprise Architecture": [
        "Architecture Framework",
        "Business Architecture",
        "Application Architecture",
        "Technology Architecture",
        "Architecture Implementation",
      ],
      "Big Data Analytics": [
        "Data Science",
        "Hadoop Ecosystem",
        "Machine Learning",
        "Data Visualization",
        "Business Intelligence",
      ],
      "Cloud Computing": [
        "Cloud Model",
        "Virtualization",
        "Cloud Security",
        "Cloud Migration",
        "Serverless Architecture",
      ],
      "Information Security Management": [
        "Security Governance",
        "Risk Management",
        "Security Standard",
        "Incident Response",
        "Cyber Resilience",
      ],
      "Business Process Management": [
        "Process Modeling",
        "Process Improvement",
        "Process Automation",
        "Process Mining",
        "Digital Process",
      ],
      "IT Governance": [
        "COBIT",
        "ITIL",
        "Risk Management",
        "Compliance",
        "Audit",
      ],
      "Digital Transformation": [
        "Digital Strategy",
        "Digital Innovation",
        "Change Management",
        "Customer Experience",
        "Digital Ecosystem",
      ],
      "Research Methodology": [
        "Research Design",
        "Data Collection",
        "Data Analysis",
        "Academic Writing",
        "Research Ethics",
      ],
      "IT Project Management": [
        "Project Planning",
        "Agile Method",
        "Risk Management",
        "Quality Assurance",
        "Project Evaluation",
      ],

      // Magister Desain
      "Metodologi Desain": [
        "Design Thinking",
        "Research Method",
        "Creative Process",
        "Design Strategy",
        "Design Evaluation",
      ],
      "Desain Strategis": [
        "Strategic Design",
        "Design Management",
        "Brand Strategy",
        "Service Design",
        "Design Leadership",
      ],
      "Desain dan Budaya": [
        "Cultural Study",
        "Design Anthropology",
        "Local Wisdom",
        "Cross-Cultural Design",
        "Design for Society",
      ],
      "Desain Eksperimental": [
        "Material Exploration",
        "Digital Fabrication",
        "Generative Design",
        "Speculative Design",
        "Design Innovation",
      ],
      "Desain dan Teknologi": [
        "Design Technology",
        "Interactive Design",
        "Smart Product",
        "Wearable Technology",
        "Design Engineering",
      ],
      "Desain Berkelanjutan": [
        "Eco Design",
        "Circular Design",
        "Sustainable Material",
        "Life Cycle Assessment",
        "Social Sustainability",
      ],
      "Visual Communication": [
        "Visual Narrative",
        "Information Design",
        "Motion Graphic",
        "Experience Design",
        "Visual Culture",
      ],
      "Design Thinking": [
        "Empathy",
        "Problem Definition",
        "Ideation",
        "Prototyping",
        "Testing",
      ],
      "Brand Strategy": [
        "Brand Positioning",
        "Brand Identity",
        "Brand Experience",
        "Brand Communication",
        "Brand Management",
      ],
      "Desain dan Masyarakat": [
        "Social Design",
        "Community Engagement",
        "Design for Development",
        "Inclusive Design",
        "Design Policy",
      ],

      // Magister Manajemen
      "Manajemen Strategik": [
        "Strategic Analysis",
        "Competitive Advantage",
        "Corporate Strategy",
        "Strategy Implementation",
        "Performance Control",
      ],
      Kepemimpinan: [
        "Leadership Theory",
        "Leadership Style",
        "Change Leadership",
        "Ethical Leadership",
        "Global Leadership",
      ],
      "Manajemen Perubahan": [
        "Change Model",
        "Change Resistance",
        "Change Communication",
        "Change Implementation",
        "Change Evaluation",
      ],
      "Manajemen Global": [
        "Global Business",
        "Cross-Cultural Management",
        "International Market",
        "Global Supply Chain",
        "Global Strategy",
      ],
      "Manajemen Inovasi": [
        "Innovation Process",
        "Creative Organization",
        "Technology Management",
        "Product Innovation",
        "Business Model Innovation",
      ],
      "Corporate Governance": [
        "Board Structure",
        "Shareholder Rights",
        "Transparency",
        "Business Ethics",
        "Corporate Social Responsibility",
      ],
      "Business Analytics": [
        "Data Mining",
        "Predictive Modeling",
        "Decision Analysis",
        "Performance Dashboard",
        "Data-Driven Decision",
      ],
      "Strategic Marketing": [
        "Market Analysis",
        "Customer Insight",
        "Brand Strategy",
        "Marketing Plan",
        "Marketing Performance",
      ],
      "Financial Management": [
        "Financial Analysis",
        "Investment Decision",
        "Risk Management",
        "Corporate Valuation",
        "Mergers & Acquisitions",
      ],
      "Human Capital Management": [
        "Talent Management",
        "Performance Management",
        "Learning Organization",
        "Compensation Strategy",
        "HR Analytics",
      ],

      // Magister Ilmu Komunikasi
      "Teori Komunikasi Lanjut": [
        "Communication Paradigm",
        "Critical Theory",
        "Cultural Studies",
        "Political Economy",
        "Media Ecology",
      ],
      "Metodologi Penelitian Komunikasi": [
        "Research Design",
        "Qualitative Method",
        "Quantitative Method",
        "Data Analysis",
        "Academic Writing",
      ],
      "Media dan Masyarakat": [
        "Media Effect",
        "Media Literacy",
        "Public Opinion",
        "Media and Democracy",
        "Media and Culture",
      ],
      "Komunikasi Organisasi": [
        "Organizational Culture",
        "Leadership Communication",
        "Change Communication",
        "Internal Communication",
        "Crisis Communication",
      ],
      "Komunikasi Politik": [
        "Political Communication",
        "Election Campaign",
        "Political Marketing",
        "Public Opinion",
        "Media and Politics",
      ],
      "Komunikasi Pemasaran Terpadu": [
        "Marketing Communication",
        "Advertising",
        "Public Relations",
        "Digital Marketing",
        "Brand Communication",
      ],
      "Media Digital": [
        "New Media",
        "Social Media",
        "Digital Culture",
        "Online Community",
        "Algorithm and Society",
      ],
      "Komunikasi Korporat": [
        "Corporate Reputation",
        "CSR Communication",
        "Investor Relation",
        "Employee Engagement",
        "Corporate Storytelling",
      ],
      "Komunikasi Antar Budaya": [
        "Cultural Dimension",
        "Intercultural Competence",
        "Global Communication",
        "Diversity Management",
        "Cross-Cultural Conflict",
      ],
      "Public Opinion": [
        "Opinion Formation",
        "Polling Method",
        "Media Influence",
        "Political Opinion",
        "Public Sentiment Analysis",
      ],

      // Doktor Ilmu Manajemen
      "Filsafat Ilmu": [
        "Epistemology",
        "Ontology",
        "Axiology",
        "Research Paradigm",
        "Science Philosophy",
      ],
      "Metodologi Penelitian": [
        "Research Design",
        "Advanced Statistics",
        "Qualitative Method",
        "Mixed Method",
        "Research Ethics",
      ],
      "Teori Manajemen Kontemporer": [
        "Management Theory",
        "Organization Theory",
        "Strategic Theory",
        "Leadership Theory",
        "Innovation Theory",
      ],
      "Manajemen Strategik Lanjut": [
        "Corporate Strategy",
        "Competitive Dynamics",
        "Resource-Based View",
        "Dynamic Capability",
        "Strategic Innovation",
      ],
      "Manajemen Inovasi": [
        "Innovation System",
        "Knowledge Management",
        "Technology Transfer",
        "Open Innovation",
        "Innovation Ecosystem",
      ],
      "Kewirausahaan Strategik": [
        "Entrepreneurial Theory",
        "Opportunity Recognition",
        "Business Model",
        "Growth Strategy",
        "Corporate Entrepreneurship",
      ],
      "Kebijakan Bisnis": [
        "Business Policy",
        "Regulatory Analysis",
        "Public Policy",
        "Global Business Environment",
        "Business Ethics",
      ],
      "Corporate Sustainability": [
        "Triple Bottom Line",
        "Sustainable Strategy",
        "Stakeholder Theory",
        "ESG",
        "Circular Economy",
      ],
      "Advanced Business Analytics": [
        "Big Data",
        "Machine Learning",
        "Predictive Modeling",
        "Decision Support System",
        "AI in Business",
      ],
      "Manajemen Pengetahuan": [
        "Knowledge Creation",
        "Knowledge Sharing",
        "Learning Organization",
        "Intellectual Capital",
        "Knowledge Management System",
      ],
    };

    const defaultTopics = [
      "Pengantar",
      "Konsep Dasar",
      "Prinsip Utama",
      "Studi Kasus",
      "Implementasi",
    ];
    const availableTopics = topics[matkul] || defaultTopics;
    const randomTopic =
      availableTopics[Math.floor(Math.random() * availableTopics.length)];

    return `${matkul}: ${randomTopic}`;
  }

  function generateDosen(prodi, matkul) {
    const defaultDosen = ["Dr. John Doe, M.Sc", "Prof. Jane Smith, Ph.D"];
    const availableDosen = dosenByProdi[prodi] || defaultDosen;
    return availableDosen[Math.floor(Math.random() * availableDosen.length)];
  }

  function generateRoom(prodi) {
    const building = prodi.includes("Teknik")
      ? "Gedung Teknik"
      : prodi.includes("Magister") || prodi.includes("Doktor")
      ? "Gedung Pascasarjana"
      : "Gedung Utama";
    const roomNumber = Math.floor(Math.random() * 50) + 1;
    return `${building} R.${roomNumber}`;
  }

  function generateClassLink(prodi, matkul) {
    const baseName = matkul
      .toLowerCase()
      .replace(/ /g, "-")
      .replace(/[^a-z0-9-]/g, "");
    return `/${prodi.toLowerCase().replace(/ /g, "-")}/${baseName}.php`;
  }

  function getBadgeClass(badgeText) {
    if (badgeText.includes("Baru")) return "badge-new";
    if (badgeText.includes("Jam")) return "badge-soon";
    return "badge-upcoming";
  }

  // Generate semua kelas
  generateAllClasses();

  // Fungsi untuk menampilkan kelas ke UI
  function displayClasses() {
    const container = document.getElementById("classes-container");
    container.innerHTML = "";

    const sortedDates = Object.keys(kelasHarian).sort();

    sortedDates.forEach((date) => {
      const dateSection = document.createElement("div");
      dateSection.className = "date-section";

      const dateHeader = document.createElement("h2");
      dateHeader.textContent = formatDisplayDate(date);
      dateSection.appendChild(dateHeader);

      for (const [prodi, matkuls] of Object.entries(kelasHarian[date])) {
        const prodiSection = document.createElement("div");
        prodiSection.className = "prodi-section";

        const prodiHeader = document.createElement("h3");
        prodiHeader.textContent = prodi;
        prodiSection.appendChild(prodiHeader);

        const classesGrid = document.createElement("div");
        classesGrid.className = "classes-grid";

        for (const [matkul, details] of Object.entries(matkuls)) {
          const classCard = document.createElement("div");
          classCard.className = "class-card";
          classCard.innerHTML = `
          <span class="class-badge ${getBadgeClass(details.badge)}">${
            details.badge
          }</span>
          <h4>${details.title}</h4>
          <div class="class-info">
            <div><i class="far fa-calendar"></i> ${details.date}</div>
            <div><i class="far fa-clock"></i> ${details.time}</div>
            <div><i class="fas fa-user-tie"></i> ${details.dosen}</div>
            <div><i class="fas fa-map-marker-alt"></i> ${details.ruang} • ${
            details.metode
          }</div>
          </div>
          <a href="${details.link}" class="class-btn">Mulai Kelas</a>
        `;
          classesGrid.appendChild(classCard);
        }

        prodiSection.appendChild(classesGrid);
        dateSection.appendChild(prodiSection);
      }

      container.appendChild(dateSection);
    });
  }

  // Inisialisasi saat DOM siap
  document.addEventListener("DOMContentLoaded", function () {
    displayClasses();
  });

  //batas
  const prodiSelect = document.getElementById("dropdown-prodi");
  const matkulSelect = document.getElementById("dropdown-matkul");

  function buatDayTabs() {
    const container = document.getElementById("dayTabs");
    container.innerHTML = "";
    for (let i = 0; i < 7; i++) {
      const date = new Date();
      date.setDate(today.getDate() + i);

      const namaHari = hariList[date.getDay()];
      const tanggal = date.getDate();
      const bulan = date.toLocaleString("id-ID", { month: "short" });
      const fullDate = date.toISOString().slice(0, 10);

      const btn = document.createElement("button");
      btn.className = "day-tab";
      btn.setAttribute("data-date", fullDate);
      btn.innerText = `${namaHari} ${tanggal} ${bulan}`;
      if (i === 0) btn.classList.add("active");

      btn.addEventListener("click", function () {
        document
          .querySelectorAll(".day-tab")
          .forEach((t) => t.classList.remove("active"));
        this.classList.add("active");
        tampilkanKelas(fullDate);
      });

      container.appendChild(btn);
    }
  }

  function tampilkanKelas(tanggal) {
    const prodi = prodiSelect.value;
    const matkul = matkulSelect.value;

    const kelas = kelasHarian[tanggal]?.[prodi]?.[matkul];

    document.getElementById("class-badge").innerText = kelas?.badge || "-";
    document.getElementById("class-title").innerText = kelas?.title || "-";
    document.getElementById("class-date").innerText = kelas?.date || "-";
    document.getElementById("class-time").innerText = kelas?.time || "-";
    document.getElementById("class-dosen").innerText = kelas?.dosen || "-";
  }

  function updateMatkul() {
    const selectedProdi = prodiSelect.value;
    matkulSelect.innerHTML = "";
    const listMatkul = prodiMatkul[selectedProdi] || [];
    listMatkul.forEach((matkul) => {
      const option = document.createElement("option");
      option.value = matkul;
      option.textContent = matkul;
      matkulSelect.appendChild(option);
    });
    const activeTab = document.querySelector(".day-tab.active");
    if (activeTab) tampilkanKelas(activeTab.getAttribute("data-date"));
  }

  prodiSelect.addEventListener("change", updateMatkul);
  matkulSelect.addEventListener("change", function () {
    const activeTab = document.querySelector(".day-tab.active");
    if (activeTab) tampilkanKelas(activeTab.getAttribute("data-date"));
  });

  // Fungsi mulai kelas
  // 3. Fungsi mulaiKelas yang sudah diperbaiki
  function mulaiKelas() {
    try {
      console.log("Memulai kelas..."); // Debugging
      
      // Validasi
      const activeTab = document.querySelector(".day-tab.active");
      if (!activeTab) throw new Error("Pilih hari terlebih dahulu");
      
      const prodi = prodiSelect.value;
      const matkul = matkulSelect.value;
      if (!prodi || !matkul) throw new Error("Pilih prodi dan mata kuliah");
      
      const tanggal = activeTab.getAttribute("data-date");
      console.log("Mencari kelas untuk:", {prodi, matkul, tanggal}); // Debugging
      
      // Cek ketersediaan kelas
      const kelas = kelasHarian[tanggal]?.[prodi]?.[matkul];
      if (!kelas) throw new Error("Tidak ada jadwal kelas untuk pilihan ini");
      
      // Cek ketersediaan topik
      if (!topics[matkul] || topics[matkul].length === 0) {
        throw new Error("Belum ada materi untuk mata kuliah ini");
      }
      
      // Simpan data ke sessionStorage
      const classData = {
        prodi,
        matkul,
        tanggal,
        topics: topics[matkul],
        classInfo: kelas
      };
      sessionStorage.setItem('currentClass', JSON.stringify(classData));
      
      console.log("Data kelas disimpan:", classData); // Debugging
      
      // Redirect ke halaman kelas
      window.location.href = 'komunikasi-politik.php';
    } catch (error) {
      console.error("Error saat memulai kelas:", error);
      alert(`Gagal memulai kelas: ${error.message}`);
    }
  }

  // 4. Pastikan event listener terpasang
  document.getElementById('mulai-kelas-btn').addEventListener('click', mulaiKelas);
  buatDayTabs();
  updateMatkul();
});


//=== Buka produk ===
function bukaProduk(namaProduk) {
  switch (namaProduk) {
    case "Paket Langganan":
      window.location.href = "paket-langganan.php";
      break;
    case "Kelas Individu":
      window.location.href = "kelas-individu.php";
      break;
    case "E Book & Modul":
      window.location.href = "ebook-modul.php";
      break;
    case "Event & Webinar":
      window.location.href = "event-webinar.php";
      break;
    default:
      alert("Halaman belum tersedia untuk: " + namaProduk);
  }
}
// ===== SHEET HANDLER =====
function showSheet(sheetToShow) {
  const sheetActive = sheets.find((sheet) => sheet.classList.contains("show"));
  if (sheetActive && sheetActive !== sheetToShow) {
    sheetActive.classList.remove("show", "no-animation");
    sheetToShow.classList.add("no-animation", "show");
    requestAnimationFrame(() => sheetToShow.classList.remove("no-animation"));
  } else if (!sheetActive) {
    overlay.classList.add("show");
    sheetToShow.classList.add("show");
    document.body.classList.add("no-scroll");
  }
}

function closeSheet() {
  overlay.classList.remove("show");
  sheets.forEach((sheet) => sheet.classList.remove("show"));
  document.body.classList.remove("no-scroll");
}

overlay.addEventListener("click", (e) => {
  if (e.target === overlay) {
    closeSheet();
  }
});

// ===== AKTIVITAS LOCALSTORAGE =====
function tambahAktivitas(namaAktivitas) {
  let data = [];

  try {
    data = JSON.parse(localStorage.getItem("aktivitasTags")) || [];
  } catch (e) {
    data = [];
  }

  // Hindari duplikat
  const sudahAda = data.some((item) => item.judul === namaAktivitas);
  if (!sudahAda && aktivitasMaster[namaAktivitas]) {
    data.unshift(aktivitasMaster[namaAktivitas]);

    // Batasi maksimal 10 aktivitas
    if (data.length > 10) data = data.slice(0, 10);

    localStorage.setItem("aktivitasTags", JSON.stringify(data));
  }

  tampilkanAktivitasHome(); // Update tampilan
}

function tampilkanAktivitasHome() {
  if (!activityTags) return;

  activityTags.innerHTML = "";
  let semuaAktivitas = [];

  try {
    semuaAktivitas = JSON.parse(localStorage.getItem("aktivitasTags")) || [];
  } catch (e) {
    semuaAktivitas = [];
  }

  const aktivitasHome = semuaAktivitas.slice(0, 4);

  aktivitasHome.forEach((item) => {
    const tag = document.createElement("a");
    tag.classList.add("tag");
    tag.textContent = item.judul;
    tag.style.backgroundColor = "#efc621 ";

    tag.addEventListener("click", (e) => {
      e.preventDefault();
      const sheet = document.getElementById(
        `${item.judul.toLowerCase().replace(/\s/g, "-")}-sheet`
      );
      if (sheet) {
        overlay.classList.add("show");
        sheet.classList.add("show");
        document.body.classList.add("no-scroll");
      }
    });

    activityTags.appendChild(tag);
  });

  if (seeAllLink) {
    seeAllLink.style.display = semuaAktivitas.length > 4 ? "inline" : "none";
  }
}

// Panggil saat DOM siap
document.addEventListener("DOMContentLoaded", () => {
  tampilkanAktivitasHome();
});

// ===== NAVBAR BOTTOM =====
const navbarAktivitas = {
  "nav-beranda": "Beranda",
  "nav-tugas": "Tugas",
  "nav-pesan": "Pesan",
  "nav-profil": "Profil",
};

Object.entries(navbarAktivitas).forEach(([id, label]) => {
  const btn = document.getElementById(id);
  if (btn) {
    btn.addEventListener("click", () => tambahAktivitas(label));
  }
});

const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll(".bottom-nav .nav-item").forEach((link) => {
  if (link.getAttribute("href").includes(currentPage)) {
    link.classList.add("active");
  } else {
    link.classList.remove("active");
  }
});

// ===== SHORTCUT MENU =====
const shortcutBtns = {
  "kelas-saya-btn": { sheet: kelasSheet, label: "Kelas Saya" },
  "materi-kuliah-btn": { sheet: materiSheet, label: "Materi Kuliah" },
  "diskusi-kelas-btn": { sheet: diskusiSheet, label: "Diskusi Kelas" },
  "toko-btn": { sheet: tokoSheet, label: "Toko" },
};

Object.entries(shortcutBtns).forEach(([btnId, { sheet, label }]) => {
  const btn = document.getElementById(btnId);
  if (btn) {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      showSheet(sheet);
      tambahAktivitas(label);

      if (label === "Kelas Saya") {
        const dayMap = ["min", "sen", "sel", "rab", "kam", "jum", "sab"];
        const todayKey = dayMap[new Date().getDay()];
        const todayBtn = document.querySelector(
          `.day-tab[data-day="${todayKey}"]`
        );
        if (todayBtn) todayBtn.click();
      }
    });
  }
});

// ===== KATEGORI MENU =====
document.querySelectorAll(".category-item").forEach((item) => {
  item.addEventListener("click", function (e) {
    e.preventDefault();
    document
      .querySelectorAll(".category-item")
      .forEach((i) => i.classList.remove("active"));
    this.classList.add("active");

    const label = this.querySelector(".category-label")?.textContent?.trim();
    switch (label) {
      case "Kelas Saya":
        showSheet(kelasSheet);
        tambahAktivitas("Kelas Saya");
        break;
      case "Materi Kuliah":
        showSheet(materiSheet);
        tambahAktivitas("Materi Kuliah");
        break;
      case "Diskusi Kelas":
        showSheet(diskusiSheet);
        tambahAktivitas("Diskusi Kelas");
        break;
      case "Toko":
        showSheet(tokoSheet);
        tambahAktivitas("Toko");
        break;
    }
  });
});

// ===== UTILITY: Ambil localStorage dengan aman =====
function getBookmarksSafe() {
  try {
    const raw = JSON.parse(localStorage.getItem("bookmarkedFolders"));
    return Array.isArray(raw) ? raw.map(String) : [];
  } catch (e) {
    return [];
  }
}

// ===== SIMPAN ke localStorage =====
function saveBookmarks(bookmarks) {
  localStorage.setItem("bookmarkedFolders", JSON.stringify(bookmarks));
}

// ===== PASANG LISTENER & UPDATE TOMBOL BOOKMARK =====
function setupBookmarkButtons() {
  const buttons = document.querySelectorAll(".bookmark-btn");
  const bookmarks = getBookmarksSafe();

  buttons.forEach((btn) => {
    const folderId = btn.getAttribute("data-folder-id");
    if (!folderId) return;
    const id = folderId.toString();

    // Tandai jika sudah di-bookmark
    if (bookmarks.includes(id)) {
      btn.classList.add("active");
    }

    // Pasang listener jika belum
    if (!btn.dataset.listenerAttached) {
      btn.addEventListener("click", () => {
        let current = getBookmarksSafe();

        if (current.includes(id)) {
          current = current.filter((x) => x !== id);
          btn.classList.remove("active");
        } else {
          current.push(id);
          btn.classList.add("active");
        }

        saveBookmarks(current);
        sortMaterialList();
      });

      btn.dataset.listenerAttached = "true";
    }
  });
}

// ===== URUTKAN MATERIAL CARD: bookmark dulu baru lainnya =====
function sortMaterialList() {
  const list = document.querySelector(".material-list");
  if (!list) return;

  const cards = Array.from(list.querySelectorAll(".material-card"));
  const bookmarks = getBookmarksSafe();

  const [bookmarked, others] = cards.reduce(
    ([a, b], card) => {
      const id = card.getAttribute("data-folder-id");
      (bookmarks.includes(id) ? a : b).push(card);
      return [a, b];
    },
    [[], []]
  );

  list.innerHTML = "";
  [...bookmarked, ...others].forEach((card) => list.appendChild(card));
}

// ===== INISIALISASI SAAT DOM SIAP =====
document.addEventListener("DOMContentLoaded", () => {
  setupBookmarkButtons();
  sortMaterialList();
});
document.addEventListener("DOMContentLoaded", () => {
  const searchIcon = document.getElementById("search-icon");
  const searchPopup = document.getElementById("search-popup");
  const searchInput = document.getElementById("floating-search-input");
  const resultBox = document.getElementById("search-result-box");

  const dataSearch = [
    { label: "Kelas Saya", kategori: "kelas", url: "#kelas-saya-btn" },
    {
      label: "Hubungan Internasional",
      kategori: "Materi Kuliah",
      url: "materi.php",
    },
    { label: "Forum", kategori: "Diskusi Kelas", url: "forum.php" },
    { label: "Paket Langganan", kategori: "Toko", url: "paket-langganan.php" },
    { label: "Paket Bulanan", kategori: "Toko", url: "paket-bulanan.php" },
    { label: "Paket Tahunan", kategori: "Toko", url: "paket-tahunan.php" },
    {
      label: "Komunikasi Politik",
      kategori: "kelas",
      url: "komunikasi-politik.php",
    },
    {
      label: "Manajemen Bisnis",
      kategori: "materi",
      url: "materi.php?id_folder=2",
    },
    { label: "Webinar", kategori: "Toko", url: "home.php#toko-btn" },
  ];

  // Toggle popup visibility
  if (searchIcon) {
    searchIcon.addEventListener("click", function (e) {
      e.preventDefault();
      this.classList.toggle("active");

      if (searchPopup.style.display === "block") {
        searchPopup.style.display = "none";
      } else {
        searchPopup.style.display = "block";
        searchInput.focus();
      }
    });
  }

  // Close popup when clicked outside
  document.addEventListener("click", function (e) {
    if (!searchPopup.contains(e.target) && !searchIcon.contains(e.target)) {
      searchPopup.style.display = "none";
      searchIcon.classList.remove("active");
    }
  });

  // Search and display result
  searchInput.addEventListener("input", function () {
    const keyword = this.value.toLowerCase();
    resultBox.innerHTML = "";

    const filtered = dataSearch.filter((item) =>
      item.label.toLowerCase().includes(keyword)
    );

    if (filtered.length === 0 && keyword !== "") {
      resultBox.innerHTML =
        "<p style='color:#999; padding: 12px;'>Tidak ditemukan.</p>";
    } else {
      filtered.forEach((item) => {
        const link = document.createElement("a");
        link.href = item.url;
        link.className = "result-link";
        link.textContent = `${item.label} (${item.kategori})`;
        resultBox.appendChild(link);
      });
    }
  });
});
