<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>
<section class="container jadwal">
    <style>
        .jadwal {
            padding: 60px 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .jadwal h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.2rem;
            color: #2d3748;
            font-weight: 600;
        }

        /* Modern Table Design */
        .schedule-table {
            width: 100%;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            border-collapse: collapse;
        }

        /* Header Row */
        .header-row {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .header-row th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            border: none;
        }

        /* Schedule Rows */
        .schedule-row {
            transition: all 0.3s ease;
            border-bottom: 1px solid #e2e8f0;
        }

        .schedule-row:hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            transform: translateX(4px);
        }

        .schedule-row:last-child {
            border-bottom: none;
        }

        .schedule-row td {
            padding: 18px 20px;
            border: none;
            vertical-align: middle;
        }

        /* Day Column */
        .day-column {
            font-weight: 600;
            color: #2d3748;
            font-size: 1rem;
            width: 40%;
        }

        .header-row .day-column {
            color: white;
        }

        /* Time Column */
        .time-column {
            color: #667eea;
            font-weight: 500;
            font-size: 1rem;
            width: 60%;
            font-family: 'Segoe UI', monospace;
        }

        .header-row .time-column {
            color: white;
        }

        /* Zebra Striping */
        .schedule-row:nth-child(even) {
            background: #f8fafc;
        }

        .schedule-row:nth-child(even):hover {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.08), rgba(118, 75, 162, 0.08));
        }

        /* Empty State */
        .schedule-table tbody tr:only-child td {
            text-align: center;
            padding: 40px 20px;
            color: #718096;
            font-style: italic;
            background: #f7fafc;
        }

        /* Mobile Responsive */
        @media screen and (max-width: 768px) {
            .jadwal {
                padding: 40px 16px;
            }

            .jadwal h2 {
                font-size: 1.8rem;
                margin-bottom: 30px;
            }

            .schedule-table {
                border-radius: 8px;
                font-size: 0.9rem;
            }

            .header-row th {
                padding: 16px 12px;
                font-size: 1rem;
            }

            .schedule-row td {
                padding: 14px 12px;
            }

            .day-column,
            .time-column {
                font-size: 0.9rem;
            }

            .schedule-row:hover {
                transform: none;
            }
        }

        @media screen and (max-width: 480px) {
            .jadwal {
                padding: 30px 12px;
            }

            .jadwal h2 {
                font-size: 1.6rem;
                margin-bottom: 24px;
            }

            .header-row th {
                padding: 12px 10px;
                font-size: 0.9rem;
            }

            .schedule-row td {
                padding: 12px 10px;
            }

            .day-column,
            .time-column {
                font-size: 0.85rem;
            }

            /* Stack layout for very small screens */
            .schedule-table,
            .header-row,
            .schedule-row,
            .header-row th,
            .schedule-row td {
                display: block;
            }

            .header-row {
                display: none;
                /* Hide header on mobile stack */
            }

            .schedule-row {
                margin-bottom: 12px;
                border-radius: 8px;
                border: 1px solid #e2e8f0;
                background: white;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            .schedule-row td {
                border: none;
                padding: 8px 12px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .day-column::before {
                content: "Hari: ";
                font-weight: 400;
                color: #718096;
            }

            .time-column::before {
                content: "Jam: ";
                font-weight: 400;
                color: #718096;
            }

            .schedule-row:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }
        }

        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .schedule-table {
            animation: fadeInUp 0.6s ease;
        }

        .schedule-row {
            animation: fadeInUp 0.6s ease;
        }

        .schedule-row:nth-child(1) {
            animation-delay: 0.1s;
        }

        .schedule-row:nth-child(2) {
            animation-delay: 0.2s;
        }

        .schedule-row:nth-child(3) {
            animation-delay: 0.3s;
        }

        .schedule-row:nth-child(4) {
            animation-delay: 0.4s;
        }

        .schedule-row:nth-child(5) {
            animation-delay: 0.5s;
        }

        .schedule-row:nth-child(6) {
            animation-delay: 0.6s;
        }

        .schedule-row:nth-child(7) {
            animation-delay: 0.7s;
        }

        /* Alternative Card Layout (Optional) */
        .jadwal.card-layout .schedule-table {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            background: transparent;
            box-shadow: none;
            border: none;
        }

        .jadwal.card-layout .header-row {
            display: none;
        }

        .jadwal.card-layout .schedule-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            margin: 0;
        }

        .jadwal.card-layout .schedule-row:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .jadwal.card-layout .day-column,
        .jadwal.card-layout .time-column {
            padding: 0;
            width: auto;
        }

        /* Add this class to container for card layout */
        /* <section class="container jadwal card-layout"> */
    </style>
    <h2>Jadwal Bimbel</h2>

    <table class="schedule-table">
        <tr class="header-row">
            <th class="day-column">Hari</th>
            <th class="time-column">Jam</th>
        </tr>
        <?php foreach ($jadwal as $jw): ?>
            <tr class="schedule-row">
                <td class="day-column"><?= $jw['hari'] ?></td>
                <td class="time-column"><?= $jw['jam_mulai'] ?>-<?= $jw['jam_selesai'] ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
</section>

<?= $this->endSection() ?>