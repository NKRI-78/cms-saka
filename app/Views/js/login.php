<script>
    $('input').keypress(function(event) {
      if (event.which == 13) { // 13 is the Enter key
        $("#login").click(); // Trigger the login button click
      }
    });

    Login = async () => {
        let data = new FormData();
        var phoneNumber = $("#phone_number").val();
        var password = $("#password").val();

        data.append('phoneNumber', phoneNumber);
        data.append('password', password);

        $("#login").text('Loading...');
        await $.ajax({
            type: "POST",
            url: `${baseUrl}/auth/login`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            success: function(response) {
                var result = JSON.parse(response);
                SetSession(result.token, result.fullname, result.userId, result.storeId, result.role);
                setInterval(function() {
                    location.href = `${baseUrl}/admin/dashboard`;
                }, 3000);
            },
            error: function(err) {
                console.log(err);
                $("#login").text('Sign in');
                toastr.error('Username or password incorrect!');
            }
        });
    }

    SetSession = (token, fullname, userId, storeId, role) => {
        let data = new FormData();
        data.append('token', token);
        data.append('fullname', fullname);
        data.append('userId', userId);
        data.append('storeId', storeId);
        data.append('role', role);

        $.ajax({
            type: "POST",
            url: `${baseUrl}/auth/session`,
            cache: false,
            contentType: false,
            processData: false,
            data: data,
        });
    }
</script>