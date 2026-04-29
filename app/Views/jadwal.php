<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>

<style>
/* ── Page base ── */
body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f4ff; }

/* ── Hero ── */
.jadwal-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 52px 20px 90px;
    text-align: center;
    color: white;
    position: relative;
    overflow: hidden;
}
.jadwal-hero::before {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.jadwal-hero .inner { position: relative; max-width: 640px; margin: 0 auto; }
.jadwal-hero h1 { font-size: 2rem; font-weight: 700; margin-bottom: 8px; }
.jadwal-hero p  { font-size: 1rem; opacity: .85; }

/* ── Content wrapper ── */
.jadwal-content {
    max-width: 860px;
    margin: -50px auto 60px;
    padding: 0 16px;
    position: relative;
    z-index: 10;
}

/* ── Info banner ── */
.info-banner {
    background: white;
    border-radius: 14px;
    box-shadow: 0 4px 20px rgba(0,0,0,.1);
    padding: 16px 22px;
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: .88rem;
    color: #4a5568;
    border-left: 4px solid #667eea;
}
.info-banner .icon { font-size: 1.4rem; flex-shrink: 0; }

/* ── Day group card ── */
.day-group {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,.07);
    border: 1px solid #e2e8f0;
    margin-bottom: 20px;
    overflow: hidden;
    animation: fadeUp .5s ease both;
}
.day-group:nth-child(1) { animation-delay: .05s; }
.day-group:nth-child(2) { animation-delay: .10s; }
.day-group:nth-child(3) { animation-delay: .15s; }
.day-group:nth-child(4) { animation-delay: .20s; }
.day-group:nth-child(5) { animation-delay: .25s; }
.day-group:nth-child(6) { animation-delay: .30s; }
.day-group:nth-child(7) { animation-delay: .35s; }

/* ── Day header ── */
.day-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 22px;
    background: linear-gradient(135deg, #f0f4ff, #ede9fe);
    border-bottom: 1px solid #e2e8f0;
}
.day-dot {
    width: 10px; height: 10px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    flex-shrink: 0;
}
.day-name {
    font-size: 1rem;
    font-weight: 700;
    color: #3730a3;
    letter-spacing: .3px;
}
.day-count {
    margin-left: auto;
    background: #eef2ff;
    border: 1px solid #c7d2fe;
    border-radius: 20px;
    padding: 2px 10px;
    font-size: .72rem;
    font-weight: 700;
    color: #4338ca;
}

/* ── Time slots grid ── */
.time-slots {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 16px 22px;
}
.time-slot {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    padding: 10px 16px;
    font-size: .88rem;
    font-weight: 600;
    color: #2d3748;
    transition: all .2s;
}
.time-slot:hover {
    background: #eef2ff;
    border-color: #a5b4fc;
    color: #3730a3;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102,126,234,.15);
}
.time-slot .clock-icon { font-size: 1rem; color: #667eea; }
.time-slot .time-range { color: #667eea; font-family: monospace; font-size: .9rem; }

/* ── Empty state ── */
.empty-state {
    text-align: center;
    padding: 70px 24px;
    background: white;
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(0,0,0,.07);
    border: 2px dashed #c7d2fe;
}
.empty-state .emoji { font-size: 4rem; display: block; margin-bottom: 14px; }
.empty-state h3 { font-size: 1.2rem; color: #2d3748; margin-bottom: 8px; }
.empty-state p  { color: #718096; font-size: .9rem; }

/* ── Animation ── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── Responsive ── */
@media (max-width: 540px) {
    .jadwal-hero h1 { font-size: 1.6rem; }
    .time-slots { gap: 8px; }
    .time-slot { padding: 8px 12px; font-size: .82rem; }
    .day-header { padding: 13px 16px; }
    .time-slots { padding: 13px 16px; }
}
</style>

<!-- Hero -->
<div class="jadwal-hero">
    <div class="inner">
        <h1>📅 Jadwal Bimbel</h1>
        <p>Lihat semua sesi belajar yang tersedia dan pilih yang sesuai dengan jadwalmu.</p>
    </div>
</div>

<div class="jadwal-content">

    <?php if (empty($jadwal)): ?>
        <div class="empty-state">
            <span class="emoji">📭</span>
            <h3>Belum ada jadwal tersedia</h3>
            <p>Jadwal bimbel akan segera diperbarui. Pantau terus halaman ini.</p>
        </div>
    <?php else: ?>

        <div class="info-banner">
            <span class="icon">💡</span>
            <span>Pilih jadwal yang sesuai saat mendaftar program bimbel. Total <strong><?= count($jadwal) ?> sesi</strong> tersedia setiap minggunya.</span>
        </div>

        <?php
            // Group jadwal by day with consistent order
            $dayOrder = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
            $grouped = [];
            foreach ($jadwal as $jw) {
                $grouped[$jw['hari']][] = $jw;
            }
            // Sort by day order
            uksort($grouped, function($a, $b) use ($dayOrder) {
                return array_search($a, $dayOrder) <=> array_search($b, $dayOrder);
            });
        ?>

        <?php foreach ($grouped as $hari => $slots): ?>
            <div class="day-group">
                <div class="day-header">
                    <span class="day-dot"></span>
                    <span class="day-name"><?= esc($hari) ?></span>
                    <span class="day-count"><?= count($slots) ?> sesi</span>
                </div>
                <div class="time-slots">
                    <?php
                        // Sort slots by jam_mulai
                        usort($slots, fn($a, $b) => strcmp($a['jam_mulai'], $b['jam_mulai']));
                    ?>
                    <?php foreach ($slots as $slot): ?>
                        <?php
                            $mulai   = substr($slot['jam_mulai'], 0, 5);
                            $selesai = substr($slot['jam_selesai'], 0, 5);
                            // Calculate duration
                            [$hM, $mM] = explode(':', $mulai);
                            [$hS, $mS] = explode(':', $selesai);
                            $durMenit = ($hS * 60 + $mS) - ($hM * 60 + $mM);
                        ?>
                        <div class="time-slot">
                            <span class="clock-icon">🕐</span>
                            <span class="time-range"><?= $mulai ?> – <?= $selesai ?></span>
                            <span style="color:#a0aec0;font-size:.78rem;font-weight:500;">(<?= $durMenit ?> mnt)</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>