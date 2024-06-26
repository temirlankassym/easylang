<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Dashboard</title>
    <style>
        body {
            background-image: url('https://www.womanhit.ru/media/CACHE/images/articleimage2/2019/2/oblozhka2_RHcI5EA/d3bc898886715775afb73d942e95336a.webp');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 30px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .projects {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .project-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: calc(33% - 20px);
            min-width: 250px;
        }

        .project-card h2 {
            color: #007bff;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .progress-bar {
            height: 8px;
            background-color: #ddd;
            border-radius: 5px;
            margin: 10px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            width: 50%;
            background-color: #007bff;
            transition: width 0.3s ease;
        }

        .due-date {
            font-style: italic;
            color: #666;
        }

        .more-info {
            color: #007bff;
            text-decoration: none;
        }

        .create-project {
            position: absolute;
            top: 100px;
            left: 400px;
            margin-top: 30px;
            text-align: center;
        }

        .archive{
            position: absolute;
            top: 100px;
            left: 200px;
            margin-top: 30px;
            text-align: center;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 400px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .user-profile {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .metrics {
            position: absolute;
            top: 0px;
            right: 200px;
        }


        .user-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
            border: 2px solid #007bff;
            transition: transform 0.3s ease;
        }

        .user-image:hover {
            transform: scale(1.1);
        }
        .notification-icon {
            position: absolute;
            top: 50px;
            left: 100px;
        }

        .notification-icon img {
            width: 30px;
            height: 30px;
        }

        .notification-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #ff0000;
            color: #fff;
            border-radius: 50%;
            padding: 5px;
            font-size: 14px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #333;
        }

        .notification {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .notification-description {
            font-size: 16px;
        }
        .projects {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .project-card {
            margin: 10px;
        }
    </style>
</head>
<body>
<!-- Add this inside your <body> tag -->
<div id="notificationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        @if(auth()->user()->role == 'translator')
            @foreach(auth()->user()->notifications as $notification)
                <div class="notification">
                    <div class="notification-info">
                        <span class="notification-description">{{ $notification->description }}.</span>
                        <span class="notification-date">Created at: {{date('H:i d M Y',strtotime($notification->created_at))}}</span>
                    </div>
                    <a href="/mark/{{$notification->id}}">
                        <img style="margin-left: 30px;max-width: 30px" src="https://cdn.pixabay.com/photo/2017/09/29/00/30/checkmark-icon-2797531_960_720.png" alt="">
                    </a>
                </div>
            @endforeach
        @endif
    </div>
</div>

<header>
    @if(auth()->user()->role == 'manager')
        <a style="margin-left: 15px;color: white;text-decoration: none" href="/staff">View Staff</a>
    @endif
    <div class="notification-icon">
        @if(auth()->user()->role == 'translator')
            <img style="width: 60px;height: 60px" src="https://static.vecteezy.com/system/resources/previews/010/366/210/original/bell-icon-transparent-notification-free-png.png" alt="Notification Icon">
            <span class="notification-count">{{ auth()->user()->notifications->count() }}</span>
        @endif
    </div>

    <div class="header-content">
        <div class="metrics">
            <h2>Translation Statistics</h2>
            <p>Translated words: {{ $translatedWords }}</p>
            <p>Words left: {{ max(0, $wordsLeft) }}</p>
        </div>
        <h1>Projects Dashboard</h1>
        <nav>
            <a href="/logout">Logout</a>
        </nav>
    </div>
    <div class="user-profile">
        <a href="/profile">
            <img src="{{ auth()->user()->image ? auth()->user()->image : 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png' }}" alt="User Image" class="user-image">
        </a>
    </div>
</header>

<main class="container">
    <div class="projects">
        @foreach($projects->where('status', 'uncompleted') as $project)
        <div class="project-card">
                <h2>{{ $project->name }}</h2>
                <p>{{ $project->description }}</p>
                <div class="progress-bar" style="max-width:400px ;width: 100%; height: 30px; background-color: #ddd; border-radius: 5px; margin-top: 10px; overflow: hidden;">
                    <div class="progress" style="height: 100%; width: {{ $project->words_count != 0 ? (floatval($project->count) / $project->words_count) * 100 : 0 }}%; background-color: #007bff; transition: width 0.3s ease; text-align: center; line-height: 30px; color: #fff; font-weight: bold;">
                        {{ $project->words_count != 0 ? round(($project->count/floatval($project->words_count)) * 100) : 0 }}%
                    </div>
                </div>
                <p class="due-date">Due: {{ date('M d, Y', strtotime($project->due_date)) }}</p>
                <a href="/projects/{{ $project->id }}" class="more-info">More Info</a>
            </div>
        @endforeach
    </div>

    @if(auth()->user()->role == 'manager')
        <div class="create-project">
            <button id="createProjectButton">Create New Project</button>
        </div>
        <div class="archive">
            <a href="/archive"><button>View finished projects</button></a>
        </div>
    @endif

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="projectForm" method="POST" action="/create">
                @csrf
                <input type="text" id="name" name="name" placeholder="Project Name" required>
                <input type="text" id="description" name="description" placeholder="Project Description" required>
                <input type="number" id="words_count" name="words_count" placeholder="Project Word Count" required>
                <input type="date" id="due_date" name="due_date" required>
                <input type="submit" value="Create Project">
            </form>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("createProjectButton");
        var span = document.getElementsByClassName("close")[0];

        var closeBtn = modal.querySelector(".close");

        closeBtn.onclick = function() {
            modal.style.display = "none";
        }

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById("notificationModal");
        var btn = document.getElementsByClassName("notification-icon")[0];
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>
</body>
</html>
