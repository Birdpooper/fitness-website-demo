// Basic BMR calculations
function basalMetabolicRate() {
  $("button").click(function () {
    if (!$("input[type=radio]").is(":checked")) {
      $(".noDisplayRadio").toggleClass("noDisplayRadio");
    }
    if ($("#height").val() == "") {
      $(".noDisplayHeight").toggleClass("noDisplayHeight");
    }
    if ($("#weight").val() == "") {
      $(".noDisplayWeight").toggleClass("noDisplayWeight");
    }
    if ($("#age").val() == "") {
      $(".noDisplayAge").toggleClass("noDisplayAge");
    } else {
      var height = $("#height").val();
      var weight = $("#weight").val();
      var age = $("#age").val();
      var gender = $("input[name=gender]:checked").val();
      if (gender == "male") {
        var bmr = Math.round(10 * weight + 6.25 * height - 5 * age + 5);
        $(".bmr").text(bmr);
      }
      if (gender == "female") {
        var bmr = Math.round(10 * weight + 6.25 * height - 5 * age - 161);
        $(".bmr").text(bmr);
      }
      $(".bmr").css("display", "inline");
      $(".inline").css("display", "inline");
      $(".bmr1").toggleClass("bmr1");
    }
  });
}

$(document).ready(function () {
  basalMetabolicRate();
});
