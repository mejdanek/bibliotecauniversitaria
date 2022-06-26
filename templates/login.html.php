<script>
    $(function () {
        $("form").submit(function (e) {
            var formInputs = {
                username: $("#form_username").val(),
                password: $("#form_password").val(),
                mail: $("#form_mail").val()
            };
            alert(formInputs);
            $.ajax({
                type: 'POST',
                data: formInputs,
                dataType: 'json'
            }).done(function (data) { <?php $_SESSION['login'] = true; ?> });
            e.preventDefault();
        });
    });
</script>
<div class="bg-light p-5 rounded">
    <div class="col-sm-8 mx-auto">
        <form method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form2Example1" class="form-control" />
                <label class="form-label" for="form2Example1">Email address</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form2Example2" class="form-control" />
                <label class="form-label" for="form2Example2">Password</label>
            </div>

            <!-- Submit button -->
            <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button>
        </form>
    </div>
</div>
