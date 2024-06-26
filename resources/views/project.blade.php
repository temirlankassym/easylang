@php use App\Models\User; @endphp
@php use App\Http\Controllers\TaskController; @endphp

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }}</title>
    <style>
        a{
            text-decoration: none;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            color: #333;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            width: 100%;
        }

        .main-content {
            margin-top: 80px; /* Adjust to match header height */
            padding: 20px;
            overflow-y: auto;
            height: calc(100vh - 80px); /* Adjust based on header height */
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        h4 {
            color: #007bff;
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 10px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
        .home-link {
            position: absolute;
            top: 30px;
            right: 100px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .profile-link {
            position: absolute;
            top: 40px;
            left: 20px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        .task-modal {
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

        .task-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .task-modal-close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .task-modal-close:hover,
        .task-modal-close:focus {
            color: #000;
            text-decoration: none;
        }
        .progress-bar {
            width: 100%;
            height: 30px;
            background-color: #ddd;
            border-radius: 5px;
            margin-top: 10px;
            overflow: hidden;
        }
        .progress {
            height: 100%;
            width: {{ $count != 0 ? ($project->words_count / $count) * 100 : 0 }}%; background-color: #007bff;
            transition: width 0.3s ease;
            text-align: center;
            line-height: 30px;
            color: #fff;
            font-weight: bold;
        }

        .home-link {
            text-decoration: none;
        }

        .home-link button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .home-link button:hover {
            background-color: #0056b3;
        }

        body {
            background-image: url('https://www.womanhit.ru/media/CACHE/images/articleimage2/2019/2/oblozhka2_RHcI5EA/d3bc898886715775afb73d942e95336a.webp');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .profile-bio {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .user-links {
            margin-left: 20px;
        }

        .user-links a {
            color: #f8f9fa;
            text-decoration: none;
            font-size: 14px;
        }

        .main-content {
            margin-top: 80px;
            padding: 20px;
            overflow-y: auto;
        }
        .button-style {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-style:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<header class="profile-bio">
    <div class="user-profile">
        <a href="/profile">
            <img src="{{ auth()->user()->image ? auth()->user()->image : 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/2048px-Default_pfp.svg.png' }}" alt="User Image" class="user-image">
        </a>
    </div>

    <div class="user-info">
        <p style="margin-left: 15px">{{ auth()->user()->firstname }}</p>
        <div class="user-links">
            <a href="/home">Home</a>
            <a style="margin-left: 15px" href="/logout">Logout</a>
        </div>
    </div>
</header>

<body>
<div class="main-content">
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="POST" action="/tasks/add/{{$project->id}}">
            @csrf
            <input type="hidden" name="project_id" value="{{$project->id}}">
            <label for="name">Task Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="taskDescription">Description:</label>
            <input type="text" id="description" name="description" required>
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date" required>
            <label for="translator">Assign to:</label>
            <select id="translator" name="assignee_id" required>
                @foreach(TaskController::getAssignee($project->id) as $translator)
                    <option value="{{ $translator->id }}">{{ $translator->firstname }}</option>
                @endforeach
            </select>
            <input type="submit" value="Add Task">
        </form>
    </div>
</div>

<!-- File Submission Modal -->
<div id="fileModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form method="POST" action="" id="fileForm" enctype="multipart/form-data">
            @csrf
            <label for="file">File:</label>
            <input type="file" id="file" name="file" required>
            <label for="words_count">Words Count:</label>
            <input type="number" id="words_count" name="words_count" required><br>
            <input type="submit" value="Submit File">
        </form>
    </div>
</div>

<!-- Project Info Modal -->
<div id="taskModal" class="task-modal">
    <div class="task-modal-content">
        <span class="task-modal-close">&times;</span>
        <h3>Task Details</h3>
        <p id="taskDetails"></p>
    </div>
</div>

<a href="/home" class="home-link"><button class="button-style">Home</button></a>
<div class="container">
    <h2>{{ $project->name }}
        @if(auth()->user()->role == 'manager')
            <button id="myBtn" class="button-style">Add new Task</button>
        @endif
    </h2>
    <p><strong>Description:</strong> {{ $project->description }}</p>

    <p><strong>Words Count:</strong> {{ $project->words_count }}/{{ $count }}</p>

    <p><strong>Due Date:</strong> {{ date('d M Y',strtotime($project->due_date)) }}</p>

    @if(count($tasks->where('status', 'uncompleted')) > 0)
        <h4>Tasks</h4>
    @endif
    <ul>
        @foreach($tasks->where('status', 'uncompleted') as $task)
            <li>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <strong>{{ $task->name }}</strong>: {{ $task->description }}
                        <br><strong>Assignee:</strong> {{ User::find($task->assignee_id)->firstname }}. Due Date: {{ date('d M Y',strtotime($task->due_date)) }}
                        @if(count($task->documents) > 0 && auth()->user()->role == 'chief')
                            <h4>Documents</h4>
                            <ul>
                                @foreach($task->documents as $document)
                                    <li>Submitted by: {{ $document->member->firstname }}</li>
                                    <li>Task name: {{ $document->task->name }}</li>
                                    <a href="{{ $document->path }}">File link </a>
                                    <button><a href="/documents/approve/{{ $document->id }}" class="btn">Approve</a></button>
                                    <button class="disapproveBtn" id="correctBtn" data-task-id="{{ $task->id }}">Disapprove</button>
                                    <div id="correctModal" class="modal">
                                        <div class="modal-content">
                                            <span class="close">&times;</span>
                                            <form method="POST" action="" id="correctForm" enctype="multipart/form-data">
                                                @csrf
                                                <label for="file">Corrected Document:</label>
                                                <input type="file" id="file" name="file" required>
                                                <label for="words_count">Words Count:</label>
                                                <input type="number" id="words_count" name="words_count" required>
                                                <input type="submit" value="Submit Corrected Document">
                                            </form>
                                        </div>
                                    </div>

                                @endforeach
                            </ul>
                        @endif
                    </div>
                    @if(auth()->user()->role == 'manager')
                        <form method="POST" action="/tasks/remove/{{ $project->id }}/{{ $task->id }}">
                            @csrf
                            <input type="hidden" name="task" value="{{ $task->id }}">
                            <input style="max-width: 120px;" type="submit" value="Remove Task">
                        </form>
                    @elseif(auth()->user()->role == 'translator')
                        <button class="submitBtn" data-task-id="{{ $task->id }}">Submit File</button>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
    <h3>Members</h3>
    <ul>
        @foreach($project->members as $member)
            <li>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        First name: {{ User::find($member->id)->firstname }}. Role: {{ $member->role }}
                    </div>
                    @if(auth()->user()->role == 'manager')
                        <form method="POST" action="/projects/remove-member/{{ $project->id }}">
                            @csrf
                            <input type="hidden" name="member" value="{{ $member->id }}">
                            <input style="max-width: 120px;" type="submit" value="Remove Member">
                        </form>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>

    @if(auth()->user()->role == 'manager' || auth()->user()->role == 'chief')
        <form method="POST" action="/projects/add-member/{{ $project->id }}">
            @csrf
            <label for="member">Add Translator:</label>
            <select id="member" name="member">
                @foreach($translators as $translator)
                    <option value="{{ $translator->id }}">{{ $translator->firstname }}</option>
                @endforeach
            </select>
            <input style="max-width: 120px;" type="submit" value="Add Member">
        </form>
    @endif

    @if(auth()->user()->role == 'manager')
        <form method="POST" action="/projects/add-member/{{ $project->id }}">
            @csrf
            <label for="member">Add Chief editor:</label>
            <select id="member" name="member">
                @foreach($chiefs as $chief)
                    <option value="{{ $chief->id }}">{{ $chief->firstname }}</option>
                @endforeach
            </select>
            <input style="max-width: 120px;" type="submit" value="Add Member">
        </form>
    @endif
    <script>
        var fileModal = document.getElementById("fileModal");
        var submitBtns = document.getElementsByClassName("submitBtn");
        var close = fileModal.querySelector(".close"); // Get the close button from the correct modal
        var fileForm = document.getElementById("fileForm");

        for (var i = 0; i < submitBtns.length; i++) {
            submitBtns[i].onclick = function() {
                fileModal.style.display = "block";
                fileForm.action = "/tasks/submit/" + this.dataset.taskId;
            }
        }

        close.onclick = function() {
            fileModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == fileModal) {
                fileModal.style.display = "none";
            }
        }
    </script>

    <script>
        var correctModal = document.getElementById("correctModal");
        var correctBtn = document.getElementById("correctBtn");
        var correctForm = document.getElementById("correctForm");

        correctBtn.onclick = function() {
            correctModal.style.display = "block";
            correctForm.action = "/tasks/submit/" + this.dataset.taskId;
        }

        window.onclick = function(event) {
            if (event.target == correctModal) {
                correctModal.style.display = "none";
            }
        }
    </script>

    <br>
    <form method="POST" action="/delete/{{$project->id}}" id="deleteForm">
        @csrf
        @method('DELETE')
        <button type="submit" style="background: none!important; border: none; padding: 0!important; color: #069; text-decoration: underline; cursor: pointer;">Delete Project</button>
    </form>
</div>
<script>
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
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
</script>
</div>
</body>
</html>
