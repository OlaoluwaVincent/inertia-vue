<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Ensure Tailwind CSS is included -->
    <style>
        @import url('https://fonts.bunny.net/css?family=Poppins:100,200,300,400,500,600,700,800,900');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f1f1;
            padding: 0;
            margin: 0;
        }

        section {
            padding: 20px;
        }

        h3 {
            text-decoration: underline;
        }

        .devName {
            text-align: center;
            font-weight: 500;
            color: rgb(0, 85, 85);
            padding: 20px;
            background: #f7f7f7;
            margin-top: 20px;
        }

        .username {
            font-weight: 500;
        }

        .dataWrapper {
            display: flex;
            flex-direction: column;
            margin-left: 20px;
            width: max-content;
        }

        .data {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        label {
            font-weight: 500;
        }

        .data>p {
            width: auto;
            border-radius: 5px;
            text-transform: uppercase;
            margin: 0;
            padding: 0;
        }

        hr {
            width: 100%;
            height: 1px;
            background-color: rgb(0, 155, 155);
            margin-bottom: 20px;
            padding: 0;
        }

        .link {
            text-decoration: none;
            color: white;
            background: teal;
            font-weight: 500;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <section>
        <h3>Payment Receipt</h3>
        <p>Dear <span class="username">{{ $user->fullname }}</span>, Your payment of
            <span class="username"> ${{ $total }}</span> was successfully completed
        </p>
        <p class="tw-my-4">You have successfully registered for the following course(s):</p>
        <div class="dataWrapper">
            @foreach ($metadata as $key => $course)
                <div class="data">
                    <label for="title">{{ $key + 1 }}</label>
                    <p>{{ $course['title'] }}</p>
                </div>
                <hr>
            @endforeach
        </div>

        <p>Thank you for your Subscription</p>
        <a class="link" href="{{ config('app.url') }}/my-courses?redirect_from=payment">Proceed</a>
    </section>
    <footer class="devName">
        Olaoluwa: Fullstack Dev@School
    </footer>
</body>

</html>
