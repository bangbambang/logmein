(function () {
  'use strict';

  $(document).ready(function () {
    let form = document.getElementById("user_create");
    let phone = document.getElementById("user_phone");

    $(form).on("submit", function (e) {
      //reset validation status
      form.classList.remove('was-validated');
      $('.form-control').each((idx, el) => {
        el.setCustomValidity("")
      })
      //block submission
      e.preventDefault();
      // 1st pass, client side validation
      if (form.checkValidity() === false) {
        form.classList.add('was-validated');
        e.stopPropagation();
      }

      // 2nd pass, server side validation
      let data = {};
      $(this).serializeArray().forEach((object) => {
        data[object.name] = object.value;
      });

      // prevent multiple submit press
      $(form).children('fieldset').prop('disabled', true);
      $.ajax({
        method: "POST",
        url: $(form).attr('action'),
        data: data // this is POST data, not JSON!
      }).done((res) => {
        //reveal the login button
        let login = document.getElementById("login_button");
        login.classList.remove('d-none');
        login.href = res.message.redirect;
      }).fail((res) => {
        let errors = res.responseJSON.message;
        // loop each error received from server, then update validity constraint
        Object.keys(errors).forEach(function (key) {
          document.getElementById(key + "_validation").innerText = errors[key].join(". ");
          document.getElementById("user_" + key).setCustomValidity(errors[key].join(". "));
        });
        // allow edit
        $(form).children('fieldset').prop('disabled', false);
      }).always(() => {
        form.classList.add('was-validated');
      });
    });

    $(phone).change(function () {
      let message="Please enter valid Indonesian mobile phone number"
      let validator = new RegExp("^(\\+?62|0)8[1-9]{1}\\d{7,9}$", "");
      if(validator.test(phone.value)) {
        phone.setCustomValidity("");
      } else {
        phone.setCustomValidity(message);
      }
    });
  });
})();

