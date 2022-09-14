<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import global_ from "@/Globales/global.vue";
import Quagga from "quagga"; // ES6
export default {
    components: { AppLayout, global_, Quagga },
    data() {
        return {
            titleForm: "Crear Articulo",
            query: "",
            articulos: [],
            articuloSelect: {},
            scannerIsRunning: false,
            form: {
                artId: 0,
                artNombre: "",
                artPrecioVenta: 0,
                artPrecioVentaDos: 0,
                artPrecioVentaTres: 0,
                monId: "",
                uniId: "",
                resId: 0,
            },
        };
    },
    methods: {
        async getArticulo() {
            if (this.query.length > 0) {
                var art = await global_.postQuery("/api/articulo", {
                    query: this.query,
                });
                this.articulos = art["articulos"];
                /* if (this.articulos.length == 0) {
          var codigos = await global_.postQuery("/api/articulocodbarra", {
            query: this.query,
          });
        } */
            }
        },
        iniciarBusqueda() {
            if (this.scannerIsRunning) {
                Quagga.stop();
            } else {
                this.startScanner();
            }
        },
        stopScanner() {
            Quagga.stop();
            this.scannerIsRunning = !this.scannerIsRunning;
        },
        startScanner() {
            this.scannerIsRunning = !this.scannerIsRunning;
            Quagga.init(
                {
                    inputStream: {
                        name: "Live",
                        type: "LiveStream",
                        target: window.document.querySelector("#camara"),
                        /* constraints: {
              width: 100,
              height: 320,
              facingMode: "environment",
            }, */
                    },
                    decoder: {
                        readers: [
                            "code_128_reader",
                            "ean_reader",
                            "ean_8_reader",
                            "code_39_reader",
                            "code_39_vin_reader",
                            "codabar_reader",
                            "upc_reader",
                            "upc_e_reader",
                            "i2of5_reader",
                        ],
                        /*  debug: {
              showCanvas: true,
              showPatches: true,
              showFoundPatches: true,
              showSkeleton: true,
              showLabels: true,
              showPatchLabels: true,
              showRemainingPatchLabels: true,
              boxFromPatches: {
                showTransformed: true,
                showTransformedBox: true,
                showBB: true,
              },
            },*/
                    },
                },
                function (err) {
                    if (err) {
                        console.log(err);
                        return;
                    }

                    Quagga.start();
                    console.log("Initialization finished. Ready to start");

                    // Set flag to is running
                    //   this.scannerIsRunning = !this.scannerIsRunning;
                }
            );

            Quagga.onProcessed(function (result) {
                var drawingCtx = Quagga.canvas.ctx.overlay,
                    drawingCanvas = Quagga.canvas.dom.overlay;

                if (result) {
                    if (result.boxes) {
                        drawingCtx.clearRect(
                            0,
                            0,
                            parseInt(drawingCanvas.getAttribute("width")),
                            parseInt(drawingCanvas.getAttribute("height"))
                        );
                        result.boxes
                            .filter(function (box) {
                                return box !== result.box;
                            })
                            .forEach(function (box) {
                                Quagga.ImageDebug.drawPath(
                                    box,
                                    { x: 0, y: 1 },
                                    drawingCtx,
                                    {
                                        color: "green",
                                        lineWidth: 2,
                                    }
                                );
                            });
                    }

                    if (result.box) {
                        Quagga.ImageDebug.drawPath(
                            result.box,
                            { x: 0, y: 1 },
                            drawingCtx,
                            {
                                color: "#00F",
                                lineWidth: 2,
                            }
                        );
                    }

                    if (result.codeResult && result.codeResult.code) {
                        Quagga.ImageDebug.drawPath(
                            result.line,
                            { x: "x", y: "y" },
                            drawingCtx,
                            {
                                color: "red",
                                lineWidth: 3,
                            }
                        );
                    }
                }
            });

            Quagga.onDetected(function (result) {
                console.log(
                    "Barcode detected and processed : [" +
                        result.codeResult.code +
                        "]",
                    result
                );
            });
        },
    },
};
</script>

<template>
    <AppLayout title="Articulo">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Gestor de Articulo</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5>Consulte</h5>
                            <span
                                >Digite Codigo Alternativo, Cod Barra,
                                Nombre</span
                            >
                        </div>
                        <hr />
                        <div class="card-body pt-0">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <input
                                                v-model="query"
                                                class="form-control"
                                                id="query"
                                                name="query"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="row">
                                            <div
                                                class="col-sm-12 col-md-6 col-lg-6"
                                            >
                                                <div class="btn-mb">
                                                    <button
                                                        class="btn btn-secondary"
                                                        type="button"
                                                        @click="getArticulo"
                                                    >
                                                        <i
                                                            class="fa-solid fa-magnifying-glass"
                                                        ></i>
                                                        consultar
                                                    </button>
                                                </div>
                                            </div>
                                            <div
                                                class="col-sm-12 col-md-6 col-lg-6"
                                            >
                                                <div
                                                    v-if="
                                                        scannerIsRunning ==
                                                        false
                                                    "
                                                    class="btn-mb"
                                                >
                                                    <button
                                                        class="btn btn-outline-primary"
                                                        type="button"
                                                        @click="startScanner"
                                                    >
                                                        <i
                                                            class="fa-solid fa-barcode"
                                                        ></i>
                                                    </button>
                                                </div>
                                                <div v-else class="btn-mb">
                                                    <button
                                                        class="btn btn-outline-primary"
                                                        type="button"
                                                        @click="stopScanner"
                                                    >
                                                        <i
                                                            class="fa-solid fa-barcode"
                                                        ></i>
                                                        <i
                                                            class="fa-solid fa-barcode-scan"
                                                        ></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div v-show="scannerIsRunning == true" class="row">
                                <div
                                    class="col-sm-12 col-md-12 col-lg-12"
                                    style="background: red"
                                >
                                    <div id="camara"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="table-responsive">
                                        <h5>Resultados</h5>
                                        <span class="text-warning"
                                            >item encontrados :
                                            {{ articulos.length }}</span
                                        >
                                        <table class="table table-bordernone">
                                            <thead>
                                                <tr>
                                                    <th>Cod. Alternativo</th>
                                                    <th>Nombre</th>
                                                    <th>Precio Venta</th>
                                                    <th>Precio Venta II</th>
                                                    <th>Precio Venta III</th>
                                                    <th>Moneda</th>
                                                    <th>Unidad</th>
                                                    <th>
                                                        <div
                                                            class="setting-primary"
                                                        >
                                                            <i
                                                                class="icon-settings"
                                                            >
                                                            </i>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr
                                                    v-for="articulo in articulos"
                                                    :key="articulo.artId"
                                                >
                                                    <td>
                                                        {{ articulo.artId }}
                                                    </td>
                                                    <td>
                                                        <div class="media">
                                                            <!-- <img
                                class="img-fluid rounded-circle"
                                src="assets/images/dashboard/product-1.png"
                                alt=""
                                data-original-title=""
                                title=""
                              /> -->
                                                            <div
                                                                class="media-body"
                                                            >
                                                                <!-- <a href="product-page.html"
                                  ><span>Yellow New Nike shoes</span></a
                                > -->
                                                                <span>{{
                                                                    articulo.artNombre
                                                                }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{
                                                                articulo.artPrecioVenta
                                                            }}
                                                            Bs.
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{
                                                                articulo.artPrecioVentaDos
                                                            }}
                                                            Bs.
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{
                                                                articulo.artPrecioVentaTres
                                                            }}
                                                            Bs.
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ articulo.monId }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p>
                                                            {{ articulo.uniId }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <button
                                                            class="btn btn-outline-primary btn-xs"
                                                            type="button"
                                                        >
                                                            <i
                                                                class="fa-solid fa-pencil"
                                                            ></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header pb-0">
                            <h5>{{ titleForm }}</h5>
                        </div>
                        <hr />
                        <div class="card-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="artId"
                                                >Codigo Alternativo</label
                                            >
                                            <input
                                                v-model="form.artId"
                                                class="form-control"
                                                id="artId"
                                                name="artId"
                                                type="number"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="artNombre"
                                                >Nombre del Articulo</label
                                            >
                                            <input
                                                v-model="form.artNombre"
                                                class="form-control"
                                                id="artNombre"
                                                name="artNombre"
                                                type="text"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="artPrecioVenta"
                                                >Precio Venta I</label
                                            >
                                            <input
                                                v-model="form.artPrecioVenta"
                                                class="form-control digits"
                                                id="artPrecioVenta"
                                                name="artPrecioVenta"
                                                type="number"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="artPrecioVentaDos"
                                                >Precio Venta II</label
                                            >
                                            <input
                                                v-model="form.artPrecioVentaDos"
                                                class="form-control digits"
                                                id="artPrecioVentaDos"
                                                name="artPrecioVentaDos"
                                                type="number"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="artPrecioVentaTres"
                                                >Precio Venta III</label
                                            >
                                            <input
                                                v-model="
                                                    form.artPrecioVentaTres
                                                "
                                                class="form-control digits"
                                                id="artPrecioVentaTres"
                                                name="artPrecioVentaTres"
                                                type="number"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-end btn-mb">
                                        <button
                                            class="btn btn-primary"
                                            type="button"
                                        >
                                            <i
                                                class="fa-solid fa-newspaper"
                                            ></i>
                                            {{ titleForm }}
                                        </button>
                                    </div>
                                </div>
                                <!-- Circles which indicates the steps of the form:-->
                                <!--  <div class="text-center">
                  <span class="step"></span><span class="step"></span
                  ><span class="step"></span><span class="step"></span>
                </div> -->
                                <!-- Circles which indicates the steps of the form:-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </AppLayout>
</template>
