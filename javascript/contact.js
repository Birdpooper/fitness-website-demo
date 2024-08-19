function sendMail() {
  var params = {
    fullname: document.getElementById("fullname").value,
    email: document.getElementById("email").value,
    phone: document.getElementById("phone").value,
    date: document.getElementById("date").value,
    time: document.getElementById("time").value,
    address: document.getElementById("address").value,
    address2: document.getElementById("address2").value,
  };

  const serviceID = "service_gww74cx";
  const templateID = "template_1eor1qs";

  emailjs
    .send(serviceID, templateID, params)
    .then((res) => {
      document.getElementById("fullname").value = "";
      document.getElementById("email").value = "";
      document.getElementById("phone").value = "";
      document.getElementById("date").value = "";
      document.getElementById("time").value = "";
      document.getElementById("address").value = "";
      document.getElementById("address2").value = "";
      console.log(res);
      alert("Your message sent successfully!!");
    })
    .catch((err) => console.log(err));
}
