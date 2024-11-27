<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ez-Parky - Smart Parking Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .navbar {
            background: #0d47a1;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar-brand:hover {
            color: #ffeb3b;
        }

        .nav-link {
            color: white;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #ffeb3b;
        }

        .hero {
            background: url('https://source.unsplash.com/1600x900/?parking,city') no-repeat center center/cover;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            background-color: #000;
            position: relative;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .changing-text-wrapper {
            position: relative;
            height: 30px; /* Adjust height to fit the text size */
            margin-bottom: 20px;
            overflow: hidden;
        }

        .changing-text {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            font-size: 1.2rem;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .changing-text.active {
            opacity: 1;
        }

        .btn-cta {
            background-color: #ffeb3b;
            color: #0d47a1;
            border: none;
            padding: 12px 24px;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-cta:hover {
            background-color: #ffd600;
            color: #0d47a1;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .btn-cta:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 235, 59, 0.5);
        }

        .features {
            padding: 60px 0;
            text-align: center;
        }

        .features h2 {
            margin-bottom: 40px;
            font-weight: bold;
        }

        .feature-item {
            margin-bottom: 20px;
        }

        .testimonials {
            background: #f8f9fa;
            padding: 60px 0;
            text-align: center;
        }

        .testimonial {
            margin: 20px 0;
            padding: 20px;
            border-radius: 8px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background: #0d47a1;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .footer a {
            color: #ffeb3b;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Ez-Parky</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Smart Parking Solution</h1>
            <div class="changing-text-wrapper">
                <p class="changing-text active">Effortless, Fast, and Secure Parking Experience.</p>
                <p class="changing-text">Collaborated with Dinas Perhubungan.</p>
                <p class="changing-text">Your Vehicle's Security is Our Priority.</p>
            </div>
            <a href="#" class="btn btn-cta">Get Started</a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Why Choose Ez-Parky?</h2>
            <div class="row">
                <div class="col-md-4 feature-item">
                    <i class="bi bi-speedometer2 fs-1 mb-3"></i>
                    <h4>Real-Time Tracking</h4>
                    <p>Monitor available slots and occupancy status in real-time.</p>
                </div>
                <div class="col-md-4 feature-item">
                    <i class="bi bi-shield-check fs-1 mb-3"></i>
                    <h4>Secure Parking</h4>
                    <p>Enhanced security measures to keep your vehicle safe.</p>
                </div>
                <div class="col-md-4 feature-item">
                    <i class="bi bi-cash-coin fs-1 mb-3"></i>
                    <h4>Easy Payment</h4>
                    <p>Cashless payments with a variety of options for your convenience.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2>What Our Users Say</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>"Ez-Parky made parking so much easier and hassle-free. Highly recommended!"</p>
                        <small>- Atmayanti</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>"The best parking solution I've ever used. Simple and efficient!"</p>
                        <small>- Adelia</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial">
                        <p>"I love the real-time tracking feature. It saves me a lot of time!"</p>
                        <small>- Silmy</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Ez-Parky. All Rights Reserved.</p>
            <p>Designed with ❤️ by <a href="#">ParkyHub</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        const texts = document.querySelectorAll('.changing-text');
        let currentIndex = 0;

        function changeText() {
            texts[currentIndex].classList.remove('active'); 
            currentIndex = (currentIndex + 1) % texts.length; 
            texts[currentIndex].classList.add('active'); 
        }
        setInterval(changeText, 3000); //3 detik
    </script>
</body>
</html>
