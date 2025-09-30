"use strict";
document.addEventListener("DOMContentLoaded", function(e) {
  var t, n, a;
  t = document.querySelector(".credit-card-mask-edit"), n = document.querySelector(".expiry-date-mask-edit"), a = document.querySelector(".cvv-code-mask-edit"), t && new Cleave(t, {
    creditCard: !0,
    onCreditCardTypeChanged: function(e) {
        $('.method').val(e)
      document.querySelector(".card-type-edit").innerHTML = "" != e && "unknown" != e ? '<img src="' + assetsPath + "img/icons/payments/" + e + '-cc.png" height="28"/>' : ""
    }
  }), n && new Cleave(n, {
    date: !0,
    delimiter: "/",
    datePattern: ["m", "y"]
  }), a && new Cleave(a, {
    numeral: !0,
    numeralPositiveOnly: !0
  }) 
 
});