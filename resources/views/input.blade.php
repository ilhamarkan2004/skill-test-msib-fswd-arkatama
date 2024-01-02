<!-- resources/views/input-form.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Input Data</title>
</head>
<body>
    <form method="POST" action="/save-person">
        @csrf
        <input type="text" name="data" placeholder="NAMA USIA KOTA">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
