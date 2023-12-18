@include('includes.siteHeader')
@yield('admin-dashboard')
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        /* Prevent scrolling when the alert is visible */
    }

    /* Fullscreen overlay with blur effect */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Adjust the alpha value for the desired level of blur */
        backdrop-filter: blur(5px);
        /* Adjust the blur value as needed */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        display: none;
        /* Initially hidden */
    }

    /* Alert box */
    .alert {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        text-align: center;
        z-index: 999999;

    }

    /* Close button */
    .close-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }
</style>


<div class="overlay" id="alertOverlay">
    <div class="alert">
        <p id="message"></p>
        <button class="close-btn btn-success" onclick="seen()">seen</button>
        <button class="close-btn" onclick="closeAlert()">Close</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Set interval to show the alert every 5 seconds
        setInterval(function() {
            fetchDataAndShowAlert();
        }, 5000);
    });
    var id = null;

    function fetchDataAndShowAlert() {
        $.ajax({
            url: '/message',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var user_id = {{ Auth::user()->id }}
                if(data.visibility == null || data.visibility == 0){
                    if(data.user_id == user_id){
                        $('#message').text(data.message);
                        $('#message').data('value', data.id);
                        showAlert();
                    }
                }else{
                        $('#message').text(data.message);
                        $('#message').data('value', data.id);
                        showAlert();
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error:', errorThrown);
            }
        });
    }

    function seen() {
        var id = $('#message').data('value');
        $.ajax({
            url: '/seen',
            method: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                console.log('Message seen:', data);
                closeAlert();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error:', errorThrown);
            }
        });
    }


    function showAlert() {
        document.getElementById('alertOverlay').style.display = 'flex';
    }

    function closeAlert() {
        document.getElementById('alertOverlay').style.display = 'none';
    }
</script>

@yield('admin-dashboard')
{{-- @include('includes.scripts') --}}
