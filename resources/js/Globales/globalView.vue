<script>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
var script = function () {
  (function ($) {
    "use strict";
    window.$(".mobile-toggle").click(function () {
      window.$(".nav-menus").toggleClass("open");
    });
    window.$(".mobile-toggle-left").click(function () {
      window.$(".left-header").toggleClass("open");
    });
    window.$(".mobile-search").click(function () {
      window.$(".form-control-plaintext").toggleClass("open");
    });
    window.$(".bookmark-search").click(function () {
      window.$(".form-control-search").toggleClass("open");
    });
    window.$(".filter-toggle").click(function () {
      window.$(".product-sidebar").toggleClass("open");
    });
    window.$(".toggle-data").click(function () {
      window.$(".product-wrapper").toggleClass("sidebaron");
    });
    window.$(".form-control-search").keyup(function (e) {
      if (e.target.value) {
        window.$(".page-wrapper.horizontal-wrapper").addClass("offcanvas-bookmark");
      } else {
        window.$(".page-wrapper.horizontal-wrapper").removeClass("offcanvas-bookmark");
      }
    });
  })(jQuery);
  window.$(window).on("scroll", function () {
    if ($(this).scrollTop() > 600) {
      $(".tap-top").fadeIn();
    } else {
      $(".tap-top").fadeOut();
    }
  });
  window.$(".media-size-email svg").on("click", function (e) {
    $(this).toggleClass("like");
  });
  window.$(".tap-top").click(function () {
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      600
    );
    return false;
  });
  // active link
  window.$(".chat-menu-icons .toogle-bar").click(function () {
    window.$(".chat-menu").toggleClass("show");
  });
  window.$(document).ready(function () {
    if (localStorage.getItem("primary") != null) {
      var primary_val = localStorage.getItem("primary");
      window.$("#ColorPicker1").val(primary_val);
      var secondary_val = localStorage.getItem("secondary");
      window.$("#ColorPicker2").val(secondary_val);
    }
    window.$(document).click(function (e) {
      window.$(".translate_wrapper, .more_lang").removeClass("active");
    });
    window.$(".translate_wrapper .current_lang").click(function (e) {
      e.stopPropagation();
      window.$(this).parent().toggleClass("active");

      setTimeout(function () {
        window.$(".more_lang").toggleClass("active");
      }, 5);
    });
  });
  /*=====================
    02. Background Image js
    ==========================*/
  window.$(".bg-center").parent().addClass("b-center");
  window.$(".bg-img-cover").parent().addClass("bg-size");
  window.$(".bg-img-cover").each(function () {
    var el = $(this),
      src = el.attr("src"),
      parent = el.parent();
    parent.css({
      "background-image": "url(" + src + ")",
      "background-size": "cover",
      "background-position": "center",
      display: "block",
    });
    el.hide();
  });
  //landing header //
  window.$(".toggle-menu").click(function () {
    window.$(".landing-menu").toggleClass("open");
  });
  window.$(".menu-back").click(function () {
    window.$(".landing-menu").toggleClass("open");
  });

  window.$(".product-size ul li ").on("click", function (e) {
    window.$(".product-size ul li ").removeClass("active");
    window.$(this).addClass("active");
  });

  window.$(".email-sidebar .email-aside-toggle ").on("click", function (e) {
    window.$(".email-sidebar .email-left-aside ").toggleClass("open");
  });

  window.$(".job-sidebar .job-toggle ").on("click", function (e) {
    window.$(".job-sidebar .job-left-aside ").toggleClass("open");
  });
};
var siderbarmenu = function () {
  window.$(".toggle-nav").click(function () {
    window.$(".nav-menu").css("left", "0px");
  });
  window.$(".mobile-back").click(function () {
    window.$(".nav-menu").css("left", "-410px");
  });

  window
    .$(".page-wrapper")
    .attr("class", "page-wrapper " + localStorage.getItem("page-wrapper"));
  window
    .$(".page-body-wrapper")
    .attr("class", "page-body-wrapper " + localStorage.getItem("page-body-wrapper"));

  if (localStorage.getItem("page-wrapper") === null) {
    window.$(".page-wrapper").addClass("compact-wrapper");
  }

  // left sidebar and horizotal menu
  if (window.$("#pageWrapper").hasClass("compact-wrapper")) {
    jQuery(".submenu-title").append(
      '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
    );
    jQuery(".submenu-title").click(function () {
      jQuery(".submenu-title").removeClass("active");
      jQuery(".submenu-title")
        .find("div")
        .replaceWith(
          '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
      jQuery(".submenu-content").slideUp("normal");
      if (jQuery(this).next().is(":hidden") == true) {
        jQuery(this).addClass("active");
        jQuery(this)
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
          );
        jQuery(this).next().slideDown("normal");
      } else {
        jQuery(this)
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
          );
      }
    });
    jQuery(".submenu-content").hide();

    jQuery(".menu-title").append(
      '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
    );
    jQuery(".menu-title").click(function () {
      jQuery(".menu-title").removeClass("active");
      jQuery(".menu-title")
        .find("div")
        .replaceWith(
          '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
        );
      jQuery(".menu-content").slideUp("normal");
      if (jQuery(this).next().is(":hidden") == true) {
        jQuery(this).addClass("active");
        jQuery(this)
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
          );
        jQuery(this).next().slideDown("normal");
      } else {
        jQuery(this)
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
          );
      }
    });
    jQuery(".menu-content").hide();
  } else if (window.$("#pageWrapper").hasClass("horizontal-wrapper")) {
    var contentwidth = jQuery(window).width();
    if (contentwidth < "992") {
      $("#pageWrapper").removeClass("horizontal-wrapper").addClass("compact-wrapper");
      $(".page-body-wrapper").removeClass("horizontal-menu").addClass("sidebar-icon");
      jQuery(".submenu-title").append(
        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
      );
      jQuery(".submenu-title").click(function () {
        jQuery(".submenu-title").removeClass("active");
        jQuery(".submenu-title")
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
          );
        jQuery(".submenu-content").slideUp("normal");
        if (jQuery(this).next().is(":hidden") == true) {
          jQuery(this).addClass("active");
          jQuery(this)
            .find("div")
            .replaceWith(
              '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
            );
          jQuery(this).next().slideDown("normal");
        } else {
          jQuery(this)
            .find("div")
            .replaceWith(
              '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
            );
        }
      });
      jQuery(".submenu-content").hide();

      jQuery(".menu-title").append(
        '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
      );
      jQuery(".menu-title").click(function () {
        jQuery(".menu-title").removeClass("active");
        jQuery(".menu-title")
          .find("div")
          .replaceWith(
            '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
          );
        jQuery(".menu-content").slideUp("normal");
        if (jQuery(this).next().is(":hidden") == true) {
          jQuery(this).addClass("active");
          jQuery(this)
            .find("div")
            .replaceWith(
              '<div class="according-menu"><i class="fa fa-angle-down"></i></div>'
            );
          jQuery(this).next().slideDown("normal");
        } else {
          jQuery(this)
            .find("div")
            .replaceWith(
              '<div class="according-menu"><i class="fa fa-angle-right"></i></div>'
            );
        }
      });
      jQuery(".menu-content").hide();
    }
  }
};
var customizer = function () {
  if (localStorage.getItem("color"))
    window
      .$("#color")
      .attr("href", "../assets/css/" + localStorage.getItem("color") + ".css");
  if (localStorage.getItem("dark")) window.$("body").attr("class", "dark-only");
  window
    .$(
      '<div class="customizer-links"> <div class="nav flex-column nac-pills" id="c-pills-tab" role="tablist" aria-orientation="vertical"> <a class="nav-link" id="c-pills-home-tab" data-bs-toggle="pill" href="#layout-type"> <div class="settings"><i class="icofont icofont-laptop-alt"></i></div><span>Check Layout</span> </a> <a class="nav-link" id="c-pills-home-tab" data-bs-toggle="pill" href="#c-pills-home"> <div class="settings"><i class="icofont icofont-ui-settings"></i></div><span>Sidebar Type</span> </a> <a class="nav-link" id="c-pills-home-tab1" data-bs-toggle="pill" href="#c-pills-profile"> <div class="settings color-settings"><i class="icofont icofont-color-bucket"></i></div><span>Color Picker</span> </a> </div><div class="customizer-contain"> <div class="tab-content" id="c-pills-tabContent"> <div class="customizer-header"> <i class="icofont-close icon-close"></i> <h5>Live customizer</h5> <p class="mb-0">Customize &amp; Preview Real Time</p></div><div class="customizer-body custom-scrollbar"> <div class="tab-pane fade show active" id="layout-type"> <ul class="sidebar-type layout-grid layout-types"> <li data-attr="defaul-layout"> <div class="layout-img"> <a href="javascript:void(0)"><img class="img-fluid" src="../assets/images/landing/demo/1.jpg" alt=""></a> <h6>Defaul layout</h6> </div></li><li data-attr="compact-layout"> <div class="layout-img"> <a href="javascript:void(0)"><img class="img-fluid" src="../assets/images/landing/demo/2.jpg" alt=""></a> <h6>Compact layout</h6> </div></li><li data-attr="modern-layout"> <div class="layout-img"> <a href="javascript:void(0)"><img class="img-fluid" src="../assets/images/landing/demo/3.jpg" alt=""></a> <h6>Modern layout</h6> </div></li></ul> </div><div class="tab-pane fade" id="c-pills-home"> <h6>Layout Type</h6> <ul class="main-layout layout-grid"> <li class="active" data-attr="ltr"> <div class="header bg-light"> <ul> <li></li><li></li><li></li></ul> </div><div class="body"> <ul> <li class="bg-light sidebar"></li><li class="bg-light body"><span class="badge badge-primary">LTR</span></li></ul> </div></li><li data-attr="rtl"> <div class="header bg-light"> <ul> <li></li><li></li><li></li></ul> </div><div class="body"> <ul> <li class="bg-light body"><span class="badge badge-primary">RTL</span></li><li class="bg-light sidebar"></li></ul> </div></li><li class="box-layout px-3" data-attr="ltr"> <div class="header bg-light"> <ul> <li></li><li></li><li></li></ul> </div><div class="body"> <ul> <li class="bg-light sidebar"></li><li class="bg-light body"><span class="badge badge-primary">Box</span></li></ul> </div></li></ul> <h6>Sidebar Typedd</h6> <ul class="sidebar-type layout-grid"> <li data-attr="normal-sidebar"> <div class="header bg-light"> <ul> <li></li><li></li><li></li></ul> </div><div class="body"> <ul> <li class="bg-dark sidebar"></li><li class="bg-light body"></li></ul> </div></li><li data-attr="compact-sidebar"> <div class="header bg-light"> <ul> <li></li><li></li><li></li></ul> </div><div class="body"> <ul> <li class="bg-dark sidebar compact"></li><li class="bg-light body"></li></ul> </div></li></ul> </div><div class="tab-pane fade" id="c-pills-profile"> <h6>Light layout</h6> <ul class="layout-grid customizer-color"> <li class="color-layout" data-attr="color-1" data-primary="#24695c" data-secondary="#ba895d"> <div></div></li><li class="color-layout" data-attr="color-2" data-primary="#d97f3d" data-secondary="#f25f4c"> <div></div></li><li class="color-layout" data-attr="color-3" data-primary="#168eea" data-secondary="#90b4cd"> <div></div></li><li class="color-layout" data-attr="color-4" data-primary="#665ed5" data-secondary="#d1d1e9"> <div></div></li><li class="color-layout" data-attr="color-5" data-primary="#3a9aa8" data-secondary="#984ff3"> <div></div></li><li class="color-layout" data-attr="color-6" data-primary="#7951aa" data-secondary="#72757D"> <div></div></li></ul> <h6>Dark Layout</h6> <ul class="layout-grid customizer-color dark"> <li class="color-layout" data-attr="color-1" data-primary="#24695c" data-secondary="#ba895d"> <div></div></li><li class="color-layout" data-attr="color-2" data-primary="#d97f3d" data-secondary="#f25f4c"> <div></div></li><li class="color-layout" data-attr="color-3" data-primary="#168eea" data-secondary="#90b4cd"> <div></div></li><li class="color-layout" data-attr="color-4" data-primary="#665ed5" data-secondary="#d1d1e9"> <div></div></li><li class="color-layout" data-attr="color-5" data-primary="#3a9aa8" data-secondary="#984ff3"> <div></div></li><li class="color-layout" data-attr="color-6" data-primary="#7951aa" data-secondary="#72757D"> <div></div></li></ul> <h6>Mix Layout</h6> <ul class="layout-grid customizer-mix"> <li class="color-layout active" data-attr="light-only"> <div class="header bg-light"> <ul> <li></li><li></li><li></li></ul> </div><div class="body"> <ul> <li class="bg-light sidebar"></li><li class="bg-light body"></li></ul> </div></li><li class="color-layout" data-attr="dark-sidebar"> <div class="header bg-light"> <ul> <li></li><li></li><li></li></ul> </div><div class="body"> <ul> <li class="bg-dark sidebar"></li><li class="bg-light body"></li></ul> </div></li><li class="color-layout" data-attr="dark-only"> <div class="header bg-dark"> <ul> <li></li><li></li><li></li></ul> </div><div class="body"> <ul> <li class="bg-dark sidebar"></li><li class="bg-dark body"></li></ul> </div></li></ul> </div></div></div></div></div>'
    )
    .appendTo(window.$("body"));
  (function () {})();

  //live customizer js
  window.$(document).ready(function () {
    $(".customizer-color li").on("click", function () {
      window.$(".customizer-color li").removeClass("active");
      window.$(this).addClass("active");
      var color = window.$(this).attr("data-attr");
      var primary = window.$(this).attr("data-primary");
      var secondary = window.$(this).attr("data-secondary");
      localStorage.setItem("color", color);
      localStorage.setItem("primary", primary);
      localStorage.setItem("secondary", secondary);
      localStorage.removeItem("dark");
      window.$("#color").attr("href", "../assets/css/" + color + ".css");
      window.$(".dark-only").removeClass("dark-only");
      location.reload(true);
    });
    window.$(".customizer-color.dark li").on("click", function () {
      window.$(".customizer-color.dark li").removeClass("active");
      window.$(this).addClass("active");
      window.$("body").attr("class", "dark-only");
      window.localStorage.setItem("dark", "dark-only");
    });

    if (localStorage.getItem("primary") != null) {
      document.documentElement.style.setProperty(
        "--theme-deafult",
        localStorage.getItem("primary")
      );
    }
    if (localStorage.getItem("secondary") != null) {
      document.documentElement.style.setProperty(
        "--theme-secondary",
        localStorage.getItem("secondary")
      );
    }
    window
      .$(
        ".customizer-links #c-pills-home-tab , .customizer-links #c-pills-layouts-tab , .customizer-links  #c-pills-home-tab1"
      )
      .click(function () {
        window.$(".customizer-contain").addClass("open");
        window.$(".customizer-links").addClass("open");
      });

    window.$(".close-customizer-btn").on("click", function () {
      window.$(".floated-customizer-panel").removeClass("active");
    });

    window.$(".customizer-contain .icon-close").on("click", function () {
      window.$(".customizer-contain").removeClass("open");
      window.$(".customizer-links").removeClass("open");
    });

    window.$(".color-apply-btn").click(function () {
      location.reload(true);
    });

    // var primary = document.getElementById("ColorPicker1").value;
    // document.getElementById("ColorPicker1").onchange = function () {
    //   primary = this.value;
    //   localStorage.setItem("primary", primary);
    //   document.documentElement.style.setProperty('--theme-primary', primary);
    // };

    // var secondary = document.getElementById("ColorPicker2").value;
    // document.getElementById("ColorPicker2").onchange = function () {
    //   secondary = this.value;
    //   localStorage.setItem("secondary", secondary);
    //   document.documentElement.style.setProperty('--theme-secondary', secondary);
    // };

    window.$(".customizer-color.dark li").on("click", function () {
      window.$(".customizer-color.dark li").removeClass("active");
      window.$(this).addClass("active");
      window.$("body").attr("class", "dark-only");
      localStorage.setItem("dark", "dark-only");
    });
    window.$(".customizer-mix li").on("click", function () {
      window.$(".customizer-mix li").removeClass("active");
      window.$(this).addClass("active");
      var mixLayout = window.$(this).attr("data-attr");
      $("body").attr("class", mixLayout);
    });

    window.$(".sidebar-main-bg-setting li").on("click", function () {
      window.$(".sidebar-main-bg-setting li").removeClass("active");
      window.$(this).addClass("active");
      var bg = window.$(this).attr("data-attr");
      window.$(".sidebar-wrapper").attr("class", "sidebar-wrapper " + bg);
    });

    window.$(".main-layout li").on("click", function () {
      window.$(".main-layout li").removeClass("active");
      window.$(this).addClass("active");
      var layout = window.$(this).attr("data-attr");
      window.$("body").attr("class", layout);
      window.$("html").attr("dir", layout);
    });

    window.$(".main-layout .box-layout").on("click", function () {
      window.$(".main-layout .box-layout").removeClass("active");
      window.$(this).addClass("active");
      var layout = window.$(this).attr("data-attr");
      window.$("body").attr("class", "box-layout");
      window.$("html").attr("dir", layout);
    });

    window.$(".sidebar-type li").on("click", function () {
      window.$("body").append("");
      console.log("test");
      var type = window.$(this).attr("data-attr");
      var boxed = "";
      if (window.$(".page-wrapper").hasClass("box-layout")) {
        boxed = "box-layout";
      }
      switch (type) {
        case "defaul-layout": {
          window
            .$(".page-wrapper")
            .attr("class", "page-wrapper compact-wrapper " + boxed);
          window.$(this).addClass("active");
          localStorage.setItem("page-wrapper", "compact-wrapper");
          break;
        }
        case "modern-layout": {
          window
            .$(".page-wrapper")
            .attr("class", "page-wrapper compact-wrapper modern-sidebar" + boxed);
          localStorage.setItem("page-wrapper", "compact-wrapper modern-sidebar");
          break;
        }
        case "compact-layout": {
          window.$(".page-wrapper").attr("class", "page-wrapper compact-sidebar" + boxed);
          localStorage.setItem("page-wrapper", "compact-wrapper compact-sidebar");
          break;
        }
        case "normal-sidebar": {
          window
            .$(".page-wrapper")
            .attr("class", "page-wrapper horizontal-wrapper " + boxed);
          window
            .$(".logo-wrapper")
            .find("img")
            .attr("src", "../assets/images/logo/logo.png");
          localStorage.setItem("page-wrapper", "horizontal-wrapper");
          localStorage.setItem("page-body-wrapper", "horizontal-menu");
          break;
        }
        case "compact-sidebar": {
          window
            .$(".page-wrapper")
            .attr("class", "page-wrapper compact-wrapper " + boxed);
          window.$(this).addClass("active");
          localStorage.setItem("page-wrapper", "compact-wrapper ");
          break;
        }
        default: {
          window
            .$(".page-wrapper")
            .attr("class", "page-wrapper compact-wrapper " + boxed);
          localStorage.setItem("page-wrapper", "compact-wrapper");
          break;
        }
      }
      // $(this).addClass("active");
      location.reload(true);
    });
  });
};
export default {
  script,
  siderbarmenu,
  customizer,
};
</script>
