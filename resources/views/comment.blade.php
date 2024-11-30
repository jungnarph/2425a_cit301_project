<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyCars | Comment</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/images/project-logo-transparent.png') }}" alt="Logo" width="auto" height="75">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/fleet">Fleet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <!-- Logout Button -->
                    @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="color: red; text-decoration: none;">Logout</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container comment-section py-4">
        <div class="row justify-content-center">
            <div class="col-md-10"> 
                <!-- Comment Form -->
                <h3 class="mb-3 mt-3 text-center"><strong>What is your experience with the Car?</strong></h3>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="car_id" value="{{ 1 }}">
                    <div class="mb-3">
                        <textarea name="content" class="form-control" rows="4" placeholder="Type your comment here..." required></textarea>
                    </div>
                    <div class="mb-3">
                    <label for="rate" class="form-label">Rate your experience:</label>
                    <div id="rate" class="stars">
                        <input type="radio" name="rate" value="1" id="star1" class="rating-star" required>
                        <label for="star1" class="star-label">&#9733;</label>
                        <input type="radio" name="rate" value="2" id="star2" class="rating-star" required>
                        <label for="star2" class="star-label">&#9733;</label>
                        <input type="radio" name="rate" value="3" id="star3" class="rating-star" required>
                        <label for="star3" class="star-label">&#9733;</label>
                        <input type="radio" name="rate" value="4" id="star4" class="rating-star" required>
                        <label for="star4" class="star-label">&#9733;</label>
                        <input type="radio" name="rate" value="5" id="star5" class="rating-star" required>
                        <label for="star5" class="star-label">&#9733;</label>
                    </div>
                        <input type="hidden" name="rate" id="rate-input" value="">
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    // Listen for changes on radio buttons
        document.querySelectorAll('.rating-star').forEach(star => {
            star.addEventListener('change', function() {
                const ratingValue = this.value; // Get the value of the clicked star
                // Update the hidden input field with the selected rating
                document.getElementById('rate-input').value = ratingValue;
            });
        });
    </script>
    <!-- Bootstrap and Font Awesome Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>