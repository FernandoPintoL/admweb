<script>
var getQuery = async function (url) {
    var existe = await axios
        .get(url)
        .then((response) => {
            existe = response.data;
            return existe;
        })
        .catch((error) => {
            if (error.response) {
                console.log(error.response.data.errors);
                existe = error.response.data.errors;
                return existe;
            }
        });
    return existe;
};

var postQuery = async function (url, data) {
    var existe = await axios
        .post(url, data)
        .then((response) => {
            // existe = response.data;
            return response;
        })
        .catch((error) => {
            console.log(error);
            if (error.response) {
                // console.log(error.response.data.errors);
                // existe = error.response.data.errors;
                return error.response;
            }
        });
    return existe;
};

var messagesErrors = function () {
    var msm = [
        {
            id: 1,
            message: "El campo es requerido",
        },
        {
            id: 2,
            message: "El campo debe ser mayor a 8 caracteres",
        },
    ];
    return msm;
};

var existeArray = function (array, id) {
    var result = array.some((element, index) => {
        return element.id == id;
    });
    return result;
};
var eleminarArray = function (array, id) {
    var result = array.filter((element, index) => {
        return element.id !== id;
    });
    return result;
};

var messageNotify = (titulo, message, tipo) => {
    window.$.NotificationApp.send(titulo, message, "top-right", "rgba(0,0,0,0.2)", tipo);
}

var ocultarOffcanvas = (id) => {
    const offcanvas = window.$(id);
    offcanvas.removeClass('show');
    offcanvas.css("visibility", "hidden");
    offcanvas.attr("aria-hidden", "true");
    offcanvas.removeAttr("role");
    offcanvas.removeAttr("aria-modal");
    const background = window.$('.modal-backdrop');
    background.remove();
};

export default {
    getQuery,
    postQuery,
    messagesErrors,
    existeArray,
    eleminarArray,
    messageNotify,
    ocultarOffcanvas
};
</script>
