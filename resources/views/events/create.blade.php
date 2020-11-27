<form action="/events" method="post">
    {{ csrf_field() }}

    <label for="title">Title:</label>
    <input type="text" name="title" id="title">

    <label for="location">Location name:</label>
    <input type="text" name="location" id="location">

    <label for="date">Date:</label>
    <input type="date" name="date" id="date">

    <label for="latitude">latitude:</label>
    <input type="text" name="latitude" id="latitude">

    <label for="longitude">longitude:</label>
    <input type="text" name="longitude" id="longitude">

    <button type="submit">Create</button>
</form>
