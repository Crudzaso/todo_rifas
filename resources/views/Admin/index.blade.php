<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Usuarios</a></li>
                <li><a href="#">Rifas</a></li>
                <li><a href="#">Ventas</a></li>
                <li><a href="#">Configuración</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="content">
        <!-- Header -->
        <header class="header">
            <h1>Bienvenido al Panel de Administración</h1>
            <div class="header-actions">
                <input type="search" placeholder="Buscar...">
                <div class="notifications">
                    <span>🔔</span>
                </div>
                <div class="profile">
                    <span>👤</span>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <section class="dashboard">
            <div class="card">
                <h3>Total Usuarios</h3>
                <p>1234</p>
            </div>
            <div class="card">
                <h3>Rifas Activas</h3>
                <p>56</p>
            </div>
            <div class="card">
                <h3>Ventas</h3>
                <p>$2340</p>
            </div>
        </section>
    </main>
</div>
</body>
</html>
