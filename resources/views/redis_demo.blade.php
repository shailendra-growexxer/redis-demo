<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redis Demo in Laravel</title>
    <!-- Add Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1>Redis Demo in Laravel</h1>
    <p>This page allows you to test various Redis operations.</p>

    <div class="list-group mb-4">
        <!-- Display available Redis operations -->
        <button class="list-group-item list-group-item-action" id="set-redis-btn">
            1. Set a Redis key
        </button>
        <button class="list-group-item list-group-item-action" id="get-redis-btn">
            2. Get Redis key
        </button>
        <button class="list-group-item list-group-item-action" id="delete-redis-btn">
            3. Delete Redis key
        </button>
        <button class="list-group-item list-group-item-action" id="increment-value-btn">
            4. Increment Redis key value
        </button>
        <button class="list-group-item list-group-item-action" id="decrement-value-btn">
            5. Decrement Redis key value
        </button>
        <button class="list-group-item list-group-item-action" id="push-to-list-btn">
            6. Push to Redis List
        </button>
        <button class="list-group-item list-group-item-action" id="get-list-btn">
            7. Get Redis List
        </button>
        <button class="list-group-item list-group-item-action" id="publish-message-btn">
            8. Publish message to Redis channel
        </button>
    </div>

    <!-- Display the input/output for each operation -->
    <div class="mb-4">
        <label for="output" class="form-label">Output:</label>
        <textarea id="output" class="form-control" rows="5" readonly></textarea>
    </div>

    <div id="input-fields" class="mb-4" style="display: none;">
        <label for="input-value" class="form-label">Enter value:</label>
        <input type="text" class="form-control" id="input-value" placeholder="Enter value here">
        <button id="submit-input" class="btn btn-primary mt-3">Submit</button>
    </div>

</div>

<!-- Add Bootstrap JS for interaction -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Function to show or hide input fields dynamically
    function toggleInputFields(show = false) {
        if (show) {
            $('#input-fields').show();
        } else {
            $('#input-fields').hide();
            $('#input-value').val(''); // Clear the input field
        }
    }

    // Function to handle button click and send Ajax request
    function sendRedisRequest(url, data = {}) {
        $('#output').val('Processing...');  // Display a loading message

        $.ajax({
            url: url,
            type: 'GET',
            data: data,
            success: function(response) {
                $('#output').val(JSON.stringify(response, null, 2));  // Display the result in the output textarea
                toggleInputFields(false);  // Hide the input fields after request
            },
            error: function() {
                $('#output').val('An error occurred.');
            }
        });
    }

    // Set a Redis key
    $('#set-redis-btn').click(function() {
        toggleInputFields(true);
        $('#submit-input').off('click').on('click', function() {
            var value = $('#input-value').val();
            if (value) {
                sendRedisRequest('/set-redis', { value: value });
            } else {
                alert('Please enter a value!');
            }
        });
    });

    // Get Redis key
    $('#get-redis-btn').click(function() {
        toggleInputFields(false);  // No need for input fields here
        sendRedisRequest('/get-redis');
    });

    // Delete a Redis key
    $('#delete-redis-btn').click(function() {
        toggleInputFields(false);
        sendRedisRequest('/delete-redis');
    });

    // Increment Redis key value
    $('#increment-value-btn').click(function() {
        toggleInputFields(false);
        sendRedisRequest('/increment-value');
    });

    // Decrement Redis key value
    $('#decrement-value-btn').click(function() {
        toggleInputFields(false);
        sendRedisRequest('/decrement-value');
    });

    // Push to Redis List
    $('#push-to-list-btn').click(function() {
        toggleInputFields(true);
        $('#submit-input').off('click').on('click', function() {
            var value = $('#input-value').val();
            if (value) {
                sendRedisRequest('/push-to-list', { value: value });
            } else {
                alert('Please enter a value!');
            }
        });
    });

    // Get Redis List
    $('#get-list-btn').click(function() {
        toggleInputFields(false);
        sendRedisRequest('/get-list');
    });

    // Publish message to Redis channel
    $('#publish-message-btn').click(function() {
        toggleInputFields(true);
        $('#submit-input').off('click').on('click', function() {
            var value = $('#input-value').val();
            if (value) {
                sendRedisRequest('/publish-message', { message: value });
            } else {
                alert('Please enter a message!');
            }
        });
    });
</script>

</body>
</html>
