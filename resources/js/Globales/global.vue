<script>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
var getQuery = async function (url) {
  var existe = await axios
    .get(url)
    .then((response) => {
      console.log(response.data);
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
      console.log(response.data);
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
export default {
  getQuery,
  postQuery,
};
</script>
