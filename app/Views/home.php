<?= $this->extend('layouts/navbar') ?>
<?= $this->section('content') ?>
<!-- Swiper JS CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.0.4/swiper-bundle.min.css" />

<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        padding: 40px 0;
        text-align: center;
    }

    .hero-photo {
        margin: 0 auto;
        max-width: 900px;
    }

    .hero-photo img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Pricing Section */
    .pricing {
        padding: 60px 0;
    }

    .pricing h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.2rem;
        color: #2d3748;
        font-weight: 600;
    }

    .cards-bimbel {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .bimbel-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .bimbel-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .bimbel-card .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .bimbel-card h3 {
        color: #667eea;
        margin-bottom: 16px;
        font-size: 1.2rem;
        font-weight: 600;
        line-height: 1.3;
    }

    .bimbel-card hr {
        border: none;
        height: 2px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        margin: 16px 0;
        border-radius: 2px;
    }

    .bimbel-card .level {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .bimbel-card p {
        color: #718096;
        margin-bottom: 8px;
        line-height: 1.5;
    }

    .bimbel-card p:last-of-type {
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        text-decoration: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-align: center;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        align-self: flex-start;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    /* Team Section */
    .team {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.03), rgba(118, 75, 162, 0.03));
        padding: 60px 0;
    }

    .team h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.2rem;
        color: #2d3748;
        font-weight: 600;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.3;
    }

    .cards-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 32px;
        max-width: 700px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .person-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }

    .person-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .person-card .photo {
        width: 100px;
        height: 100px;
        margin: 0 auto 20px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #667eea;
    }

    .person-card .photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .person-card .info strong {
        display: block;
        color: #2d3748;
        font-size: 1.1rem;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .person-card .info p {
        color: #667eea;
        font-weight: 500;
        font-size: 0.95rem;
    }

    /* Alumni Section */
    .alumni {
        padding: 60px 0;
    }

    .alumni h2 {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2.2rem;
        color: #2d3748;
        font-weight: 600;
    }

    /* Enhanced Swiper Styles */
    .swiper {
        width: 100%;
        padding-bottom: 60px;
    }

    .swiper-slide {
        height: auto;
        display: flex;
        justify-content: center;
    }

    .swiper .person-card {
        width: 100%;
        margin: 0 auto;
        min-height: 200px;
    }

    .swiper .person-card .photo {
        width: 80px;
        height: 80px;
        margin: 0 auto 16px;
    }

    .swiper .person-card .info strong {
        font-size: 1rem;
        margin-bottom: 6px;
    }

    .swiper .person-card .info p {
        font-size: 0.85rem;
        line-height: 1.4;
    }

    /* Swiper Navigation */
    .swiper-button-next,
    .swiper-button-prev {
        background: white;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
        color: #667eea;
        border: 1px solid #e2e8f0;
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 16px;
        font-weight: 600;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: #667eea;
        color: white;
        transform: scale(1.05);
    }

    .swiper-pagination {
        bottom: 10px;
    }

    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #cbd5e0;
        opacity: 1;
        transition: all 0.3s ease;
    }

    .swiper-pagination-bullet-active {
        background: #667eea;
        transform: scale(1.2);
    }

    /* Empty State */
    .cards-bimbel>div[style*="text-align: center"] {
        grid-column: 1 / -1;
        background: #f7fafc;
        padding: 40px;
        border-radius: 12px;
        color: #718096;
        font-size: 1.1rem;
        border: 2px dashed #cbd5e0;
    }

    /* Responsive Design */
    @media screen and (max-width: 992px) {
        .cards-bimbel {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .pricing h2,
        .team h2,
        .alumni h2 {
            font-size: 2rem;
        }
    }

    @media screen and (max-width: 768px) {
        .cards-bimbel {
            grid-template-columns: 1fr;
            gap: 16px;
            padding: 0 16px;
        }

        .cards-2 {
            grid-template-columns: 1fr;
            gap: 24px;
            padding: 0 16px;
        }

        .hero {
            padding: 30px 0;
        }

        .hero-photo img {
            height: 220px;
            border-radius: 8px;
        }

        .pricing,
        .team,
        .alumni {
            padding: 40px 0;
        }

        .pricing h2,
        .team h2,
        .alumni h2 {
            font-size: 1.8rem;
            margin-bottom: 30px;
        }

        .bimbel-card,
        .person-card {
            padding: 20px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            display: none;
        }

        .swiper {
            padding-bottom: 50px;
        }
    }

    @media screen and (max-width: 480px) {
        .hero-photo img {
            height: 180px;
        }

        .pricing h2,
        .team h2,
        .alumni h2 {
            font-size: 1.6rem;
        }

        .bimbel-card h3 {
            font-size: 1.1rem;
        }

        .person-card .photo {
            width: 80px;
            height: 80px;
        }

        .swiper .person-card .photo {
            width: 70px;
            height: 70px;
        }
    }
</style>

<!-- Hero / Foto besar -->
<section class="hero">
    <div class="container">
        <div class="hero-photo">
            <img src="<?= base_url('assets/images/hero.jpg') ?>" />
        </div>
    </div>
</section>

<!-- Rincian Biaya -->
<section class="pricing">
    <div class="container">
        <h2>Rincian Biaya Bimbel</h2>
        <div class="cards-bimbel">
            <?php if (empty($program)): ?>
                <div style="text-align: center; padding: 20px;">
                    Tidak ada program bimbel yang tersedia
                </div>
            <?php else: ?>
                <?php foreach ($program as $pg): ?>
                    <div class="cards bimbel-card">
                        <div class="card">
                            <h3><?= $pg['nama_program'] ?> - <?= $pg['durasi'] ?></h3>
                            <hr />
                            <p class="level">Tingkat <?= $pg['tingkat'] ?>:</p>
                            <p>Kelas <?= $pg['kelas'] ?>: <?= $pg['harga'] ?></p>
                            <p>Keterangan :</p>
                            <p style="margin-bottom: 10px;"><?= $pg['keterangan'] ?></p>
                            <a href="<?= base_url('/registrasi-pembayaran') ?>" class="btn btn-primary">Daftar Sekarang</a>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


    </div>
</section>

<!-- Pengajar & Owner -->
<section class="team">
    <div class="container">
        <h2>Pengajar &amp; Owner Home Schooling Bimbel Harapan</h2>
        <div class=" cards-2">
            <div class=" person-card">
                <div class="photo">
                    <img src="<?= base_url('assets/images/pengajar.jpg') ?>" alt="pengajar" />
                </div>
                <div class="info">
                    <strong>Siti Komariah S.Pd</strong>
                    <p>Pengajar</p>
                </div>
            </div>
            <div class=" person-card">
                <div class="photo">
                    <img src="<?= base_url('assets/images/pengajar.jpg') ?>" alt="pengajar" />
                </div>
                <div class="info">
                    <strong>hutabarat S.H</strong>
                    <p>Pengajar &amp; Owner</p>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Siswa Diterima PTN (Menggunakan Swiper) -->
<section class="alumni">
    <div class="container">
        <h2>Siswa-Siswi Bimbel Harapan Yang Diterima PTN</h2>

        <!-- Swiper container -->
        <div class="swiper alumni-swiper">
            <div class="swiper-wrapper">
                <!-- Individual slides -->
                <?php foreach ($siswa as $sw): ?>
                    <div class="swiper-slide">
                        <div class="person-card">
                            <div class="photo">
                                <img src="<?= base_url('uploads/siswa-ptn/' . $sw['photo']) ?>" />
                            </div>
                            <div class="info">
                                <strong><?= $sw['nama_siswa'] ?></strong>
                                <p><?= $sw['prodi'] ?> – <?= $sw['nama_kampus'] ?> (<?= $sw['tahun_diterima'] ?>)</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>



                <!-- You can add more slides as needed -->
            </div>

            <!-- Navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Pagination dots -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>



<!-- Swiper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.0.4/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.alumni-swiper', {
            // Optional parameters
            loop: true,
            slidesPerView: 1,
            spaceBetween: 30,
            grabCursor: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },

            // Responsive breakpoints
            breakpoints: {
                // When window width is >= 640px
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // When window width is >= 768px
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                // When window width is >= 1024px
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 40
                }
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>
<?= $this->endSection() ?>