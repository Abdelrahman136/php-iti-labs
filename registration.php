<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Inter', sans-serif; /* Using Inter font */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 700px;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }
        h2 {
            color: #4f46e5; /* Indigo-700 equivalent */
            font-weight: bold;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 600;
            color: #343a40;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea; /* Indigo-500 equivalent */
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background-color: #4f46e5; /* Indigo-600 equivalent */
            border-color: #4f46e5;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #4338ca; /* Indigo-700 equivalent */
            border-color: #4338ca;
            transform: scale(1.05);
        }
        .btn-secondary {
            background-color: #6c757d; /* Gray-300 equivalent */
            border-color: #6c757d;
            color: #ffffff;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Gray-400 equivalent */
            border-color: #5a6268;
            transform: scale(1.05);
        }
        .captcha-box {
            background-color: #e2e8f0; /* Gray-200 equivalent */
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 2px;
            color: #4f46e5;
            min-width: 120px;
            text-align: center;
        }
        .form-check-input:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Registration</h2>
        <form action="registrationHandelar.php" method="POST">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-select" id="country" name="country" required>
                    <option value="">Select Country</option>
                    <option value="Egypt">Egypt</option>
                    <option value="USA">USA</option>
                    <option value="Canada">Canada</option>
                    <option value="UK">United Kingdom</option>
                    <option value="Germany">Germany</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male" required>
                        <label class="form-check-label" for="genderMale">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female" required>
                        <label class="form-check-label" for="genderFemale">Female</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Skills</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="skills[]" id="skillPHP" value="PHP">
                            <label class="form-check-label" for="skillPHP">PHP</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="skills[]" id="skillMySQL" value="MySQL">
                            <label class="form-check-label" for="skillMySQL">MySQL</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="skills[]" id="skillJ2SE" value="J2SE">
                            <label class="form-check-label" for="skillJ2SE">J2SE</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="skills[]" id="skillPostgreSQL" value="PostgreSQL">
                            <label class="form-check-label" for="skillPostgreSQL">PostgreSQL</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" value="OpenSource">
            </div>
            <div class="mb-3 d-flex align-items-center">
                <label for="captcha" class="form-label me-3 mb-0">Please Insert the code below box</label>
                <span id="captchaCode" class="captcha-box me-3"></span>
                <input type="text" class="form-control w-auto" id="captcha" name="captcha" required>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary me-3">Submit</button>
                <button type="reset" class="btn btn-secondary" onclick="generateAndDisplayCaptcha()">Reset</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // JavaScript for CAPTCHA generation
        function generateCaptcha() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < 6; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return result;
        }

        function generateAndDisplayCaptcha() {
            const captchaElement = document.getElementById('captchaCode');
            const newCaptcha = generateCaptcha();
            captchaElement.textContent = newCaptcha;
        }

        // Generate CAPTCHA on page load
        document.addEventListener('DOMContentLoaded', generateAndDisplayCaptcha);
    </script>
</body>
</html>
