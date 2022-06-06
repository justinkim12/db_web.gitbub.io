<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js" integrity="sha384-CHAAfwzjNJHrJ8cZidOg56tcQWfp6y72vEJ8xQ9w6Quywb24iOsW913URv1IS4GD" crossorigin="anonymous"></script>

</head>

<body>
    <form action="signupProcess.php" method="POST" id="signup-form">
        <div class="w-50 ml-auto mr-auto mt-5">
        <div class="mb-3 ">
                <label for="email" class="form-label">아이디</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="아이디를 입력해 주세요.">
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">비밀번호</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="비밀번호를 입력해 주세요.">
            </div>
            <div class="mb-3 ">
                <label for="passwordCheck" class="form-label">비밀번호 체크</label>
                <input type="password" class="form-control" id="password-check" placeholder="비밀번호를 입력해 주세요.">
            </div>
            <div class="mb-3 ">
                <label for="passwordCheck" class="form-label">가장 좋아하는 선수</label>
                <br>
                <input type="text" name="firstname" id='firstname' placeholder="firstname">
				<input type="text" name="lastname" id='lastname' placeholder="lastname">   
            </div>
            <div class='mb-4'>
                <label for="favorite team">가장 좋아하는 팀</label>
                <br>
                <select name="selectbox" id="selectbox" >
                                <option value="" selected disabled>Favorite Team</option> 
                                <option value="ATL">ATL</option>
                                <option value="BOS">BOS</option>
                                <option value="BKN">BKN</option>
                                <option value="CHA">CHA</option>
                                <option value="CHI">CHI</option>
                                <option value="DAL">DAL</option>
                                <option value="DEN">DEN</option>
                                <option value="DET">DET</option>
                                <option value="GSW">GSW</option>
                                <option value="HOU">HOU</option>
                                <option value="IND">IND</option>
                                <option value="LAC">LAC</option>
                                <option value="LAL">LAL</option>
                                <option value="MEM">MEM</option>
                                <option value="MIA">MIA</option>
                                <option value="MIL">MIL</option>
                                <option value="MIN">MIN</option>
                                <option value="NOP">NOP</option>
                                <option value="NYK">NYK</option>
                                <option value="OKC">OKC</option>
                                <option value="ORL">ORL</option>
                                <option value="PHI">PHI</option>
                                <option value="PHO">PHO</option>
                                <option value="POR">POR</option>
                                <option value="SAC">SAC</option>
                                <option value="SAN">SAN</option>
                                <option value="TOR">TOR</option>
                                <option value="TOR">TOR</option>
                                <option value="UTA">UTA</option>
                                <option value="WAS">WAS</option>
                                
				</select>
            </div>
            <button type="button" id="signup-button" class="btn btn-primary mb-3">회원가입</button>
        </div>
    </form>
    <script>
        const signupForm = document.querySelector("#signup-form");
        const signupButton = document.querySelector("#signup-button");
        const password = document.querySelector("#password");
        const passwordCheck = document.querySelector("#password-check");
        signupButton.addEventListener("click", function(e) {
            if(password.value&& password.value === passwordCheck.value){
                
            signupForm.submit();
            }else{
                alert("비밀번호가 서로 일치하지 않습니다");
            }
        });
    </script>
</body>

</html>