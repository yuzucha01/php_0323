
      var firebaseConfig = {
        apiKey: "AIzaSyBRgS2Ry5SOkfBQltITyRsbxcMeqLWccrw",
        authDomain: "camp-08-cea2d.firebaseapp.com",
        projectId: "camp-08-cea2d",
        storageBucket: "gs://camp-08-cea2d.appspot.com",
        messagingSenderId: "56866604396",
        appId: "1:56866604396:web:009e5a6b986f8560dbdf49",
        databaseURL: "https://camp-08-cea2d-default-rtdb.firebaseio.com/",
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);

      //---------------------ここから下にjqueryの処理------------------------------------------------------------

      //firebaseのデーター
      let newPostRef = firebase.database().ref();

      //   日時
      function toLocaleString(date) {
        return (
          [date.getFullYear(), date.getMonth() + 1, date.getDate()].join(" / ")
        );
      }
      // 送信ボタンをクリック処理
        $("#send").on("click", function () {
         // firebaseにデータを入れる
        newPostRef.push({
          name: $("#name").val(), //料理名
          text: $("#text").val(), //材料
          recipe: $("#recipe").val(), //レシピ
          date: toLocaleString(new Date()),
        });

       // 空白
        $("#name").val("");
        $("#text").val("");
        $("#recipe").val("");

      // ファイルアップロード
        var files = document.getElementById('file').files;
        var image = files[0];

        var ref = firebase.storage().ref().child(image.name);
        ref.put(image).then(function (snapshot) {
        alert('アップロードしました');
        });



      });

     // firebaseからの受信
      newPostRef.on("child_added", function (data) {
        let a = data.val();
          let str = `<div id= "chat-common">
          <div class = "chat-name">${a.name}</div>
          <br>
          <div class = "chat-text">${a.text}</div>
          <br>
          <div class = "chat-recipe">${a.recipe}</div>
          <br>
          <div class = "chat-date">${a.date}</div>
          </div>`;
          $(".chat-area").prepend(str);
      });


//firebaseのstorageから画像を表示する
//htmlのonclickにfunctionを入れる
function a () {
    var storageRef = firebase.storage().ref();
    //storageの表示する画像を選択
    //------------storageからアップロードした写真を更新して報じさせたい-----------------------------------------------------
    storageRef.child(`o0480072012859098818.jpg`).getDownloadURL().then(function (url) {
        var test = url;
        //画像の表示先
        document.getElementById("chat-common").style.backgroundImage = "url("+url+")";
    }).catch(function (error) {
        console.log(error);
    });

}



