<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        .attendance-form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
        }
        .button-group button {
            padding: 10px 15px;
            border: none;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .button-group button:hover {
            background-color: #0056b3;
        }
        .attendance-records {
            margin-top: 20px;
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <h1>Staff Attendance</h1>
    <div class="attendance-form">
        <form id="attendanceForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="staffName">Staff Name:</label>
                <input type="text" id="staffName" name="staffName" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="entryTime">Entry Time:</label>
                <input type="time" id="entryTime" name="entryTime" required>
            </div>
            <div class="form-group">
                <label for="exitTime">Exit Time:</label>
                <input type="time" id="exitTime" name="exitTime" required>
            </div>
            <div class="button-group">
                <button type="submit">Submit</button>
                <button type="button" >View Records</button>
            </div>
        </form>
    </div>

    <div class="attendance-records" id="attendanceRecords" style="display: none;">
        <h2>Weekly Attendance Records</h2>
        <ul id="recordsList"></ul>
    </div>

   
</body>
</html>
