window.addEventListener("load", () => {
    clock();
    function clock() {
      const today = new Date();
      const hours = today.getHours();
      const minutes = today.getMinutes();
      const seconds = today.getSeconds();
      const hour = hours < 10 ? "0" + hours : hours;
      const minute = minutes < 10 ? "0" + minutes : minutes;
      const second = seconds < 10 ? "0" + seconds : seconds;
      const hourTime = hour > 12 ? hour - 12 : hour;
      const ampm = hour < 12 ? "AM" : "PM";
      const month = today.getMonth();
      const year = today.getFullYear();
      const day = today.getDate();
      const monthList = [
        "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
      ];
      const date = monthList[month] + " " + day + ", " + year;
      const time = hourTime + ":" + minute + ":" + second + ampm;
      const dateTime = date + " - " + time;
      document.getElementById("date-time").innerHTML = dateTime;
      setTimeout(clock, 1000);
    }
});

//webcam
Webcam.set({
  width: 320,
  height: 240,
  image_format: 'jpeg',
  jpeg_quality: 90
});

Webcam.attach( '#my_camera' );
    


function take_snapshot() {


  Webcam.snap(function(data_uri) {
      document.getElementById('image_data').value = data_uri;
  });
}

