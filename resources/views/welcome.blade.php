<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }
        .btn-primary {
            background-color: #6610f2;
            border: none;
        }
        .btn-primary:hover {
            background-color: #520dc2;
        }
        .title {
            font-weight: 700;
            font-size: 2rem;
            color: #222;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="card p-5 bg-white text-dark col-md-6 mx-auto">
            <h1 class="title mb-3">🎓 School Management System</h1>
            <p class="text-muted mb-4">
                Manage Students, Teachers, and Parents.
            </p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>

            </div>
        </div>
    </div>
</body>
</html>
