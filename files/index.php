<?php

// Connect to PostgreSQL
$conn = pg_connect(
    "host=localhost dbname=vn7 user=code password=12345"
);

// Check connection
if (!$conn) {
    die("Database connection failed.");
}

// Get users from database
$query = "SELECT * FROM sm_users ORDER BY id";
$result = pg_query($conn, $query);

if (!$result) {
    die("Database query failed.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Dynamic Portfolio</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, #312e81, transparent 35%),
                radial-gradient(circle at bottom right, #0e7490, transparent 35%),
                #020617;
            color: white;
            min-height: 100vh;
        }

        /* Navigation */

        nav {
            width: 100%;
            padding: 22px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(2,6,23,0.65);
            backdrop-filter: blur(12px);
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #a78bfa;
        }

        nav a {
            color: #cbd5e1;
            text-decoration: none;
            margin-left: 25px;
            transition: 0.3s;
        }

        nav a:hover {
            color: white;
        }

        /* Hero */

        .hero {
            text-align: center;
            padding: 90px 20px 60px;
        }

        .hero h1 {
            font-size: clamp(45px, 7vw, 80px);
            margin-bottom: 20px;
            background: linear-gradient(
                90deg,
                #60a5fa,
                #a78bfa,
                #f472b6
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            max-width: 650px;
            margin: auto;
            color: #cbd5e1;
            font-size: 18px;
            line-height: 1.7;
        }

        .status {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            border-radius: 30px;
            background: rgba(34,197,94,0.12);
            border: 1px solid rgba(34,197,94,0.3);
            color: #86efac;
        }

        /* Portfolio */

        .portfolio {
            width: 85%;
            max-width: 1200px;
            margin: auto;
            padding-bottom: 80px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 35px;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #94a3b8;
        }

        .cards {
            display: grid;
            grid-template-columns:
                repeat(auto-fit, minmax(270px, 1fr));
            gap: 25px;
        }

        /* Profile Card */

        .card {
            position: relative;
            padding: 30px;
            border-radius: 22px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(15px);
            transition: 0.35s ease;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            background: #6366f1;
            filter: blur(70px);
            opacity: 0.25;
            top: -50px;
            right: -50px;
        }

        .card:hover {
            transform: translateY(-10px);
            border-color: #818cf8;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        .avatar {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(
                135deg,
                #6366f1,
                #ec4899
            );
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card h3 {
            font-size: 23px;
            margin-bottom: 8px;
        }

        .job {
            color: #a78bfa;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .info {
            margin-top: 12px;
            color: #cbd5e1;
            font-size: 14px;
        }

        .info strong {
            color: white;
        }

        /* Footer */

        footer {
            text-align: center;
            padding: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 600px) {

            nav {
                padding: 20px;
            }

            nav a {
                display: none;
            }

            .hero {
                padding-top: 60px;
            }

            .portfolio {
                width: 90%;
            }

        }

    </style>

</head>

<body>

    <!-- Navigation -->

    <nav>

        <div class="logo">
            DEV.PORTFOLIO
        </div>

        <div>
            <a href="#">Home</a>
            <a href="#team">Profiles</a>
        </div>

    </nav>


    <!-- Hero Section -->

    <section class="hero">

        <div class="status">
            ● Database Connected
        </div>

        <h1>
            Dynamic Portfolio
        </h1>

        <p>
            A dynamic portfolio powered by
            PHP, PostgreSQL, Apache and Ansible.
            All profile information displayed below
            is retrieved directly from the database.
        </p>

    </section>


    <!-- Portfolio Section -->

    <section class="portfolio" id="team">

        <div class="section-title">

            <h2>Our Profiles</h2>

            <p>
                Dynamically loaded from PostgreSQL
            </p>

        </div>


        <div class="cards">

            <?php while ($row = pg_fetch_assoc($result)): ?>

                <div class="card">

                    <div class="avatar">
                        <?php
                            echo strtoupper(
                                substr($row['name'], 0, 1)
                            );
                        ?>
                    </div>

                    <h3>
                        <?php
                            echo htmlspecialchars($row['name']);
                        ?>
                    </h3>

                    <div class="job">
                        <?php
                            echo htmlspecialchars($row['job']);
                        ?>
                    </div>

                    <div class="info">
                        <strong>Education:</strong>
                        <?php
                            echo htmlspecialchars($row['course']);
                        ?>
                    </div>

                    <div class="info">
                        <strong>Email:</strong>
                        <?php
                            echo htmlspecialchars($row['email']);
                        ?>
                    </div>

                    <div class="info">
                        <strong>Phone:</strong>
                        <?php
                            echo htmlspecialchars($row['phone']);
                        ?>
                    </div>

                    <div class="info">
                        <strong>Available:</strong>
                        <?php
                            echo htmlspecialchars($row['time']);
                        ?>
                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    </section>


    <!-- Footer -->

    <footer>

        Dynamic Portfolio |
        PHP + PostgreSQL + Apache |
        Deployed with Ansible

    </footer>

</body>

</html>

<?php

pg_close($conn);

?>


