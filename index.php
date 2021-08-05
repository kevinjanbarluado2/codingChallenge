<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Sample UI | Kevin Coding Challenge</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron">
                    <h1 class="display-4">Hello, guys!</h1>
                    <p class="lead">This is just a sample UI. You can access the functionalities by using REST API (Postman)</p>
                    <hr class="my-4">
                    <br>Chance: <span class="font-weight-bold text-primary" id="chance"></span> <small class="font-weight-light">(Integer Format)</small>
                    <br>Winning Moment: <span id="winningMoment" class="font-weight-bold text-primary"></span> <small class="font-weight-light">(TimeStamp Format)</small>
                    <p class="lead">
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="client" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="email">Mechanics</label>
                            <select id="mechanics" class="form-control">
                                <option value="chance">chance</option>
                                <option value="winning_moment">winning moment</option>
                            </select>
                        </div>
                        <button type="button" id="addEntrant" class="btn btn-primary">Insert</button>
                    </form>
                    </p>
                </div>
            </div>
        </div>


    </div>



</body>
<script>
    $(function() {
        $.ajax({
            url: './entrant/chance',
            dataType: 'json',
            success: function(data) {
                $('#chance').html(data.value);
            }
        });
        $.ajax({
            url: './entrant/winning-moment',
            dataType: 'json',
            success: function(data) {
                dt = new Date(data.value * 1000);
                $('#winningMoment').html(dt.toLocaleString());
            }
        });

        $('#addEntrant').on('click', function() {
            let arr = {};
            arr.client = $('#client').val();
            arr.email = $('#email').val();
            arr.mechanics = $('#mechanics').val();
            $.ajax({
                url: './promotion',
                type: 'get',
                data: arr,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    
                        if(data.win==true){
                            alert('Congratulations! You Won');
                        }
                        else{
                            alert('Sorry. Better luck next time');
                        }
                        

                   
                  
                }
            });


        });


    });
</script>

</html>