<template>
    <div>
        <div class="dragstartzone" @mousedown="startDrag" @mousemove="doDrag">
            <div :style='{left:x, top:y, position:"absolute", width : "150px"}'><img src="img/pikachu.png" alt="cursor"></div>
        </div>
        <div>
            x: {{ x }}
            y: {{ y }}
        </div>
    </div>
</template>

<script>
export default {
    name: "Puzzle",
    data(){
        return {
            movil : '',
            tamWidth : [134,192,134,163,134,163,134,192,134],
            tamHeight : [163,134,163,134,192,134,163,134,163],
            elementSelect : 0,
            currentX : 0,
            currentY : 0,
            currentPosX : 0,
            currentPosY : 0,
            dragging: false,
            x : "20px",
            y : "20px"
        };
    },
    mounted() {
        window.addEventListener('mouseup', this.stopDrag);
        /*this.elementSelect = window.document.getElementById('img');
        this.elementSelect.onmousedown = (event) => this.presionar(event);
        this.elementSelect.style.top = "140px";
        this.elementSelect.style.left = "10px";
        console.log(this.elementSelect);*/
    },
    methods: {
        startDrag() {
            this.dragging = true;
            this.x = this.y = "0px";
        },
        stopDrag() {
            this.dragging = false;
            this.x = this.y = 'no';
        },
        doDrag(event) {
            if (this.dragging) {
                console.log(event);
                this.x = event.clientX+"px";
                this.y = event.clientY+"px";
            }
        },
        ubicacion(event){
            this.x = event.clientX+"px";
            this.y = event.clientY+"px";
        },
        presionar(event){
            //event.target.style.background = 'black';
            console.log('inicio precionar');
            console.log(event);
            this.x = event.clientX+"px";
            this.y = event.clientY+"px";
            console.log(this.elementSelect);
        },
        soltar(event){
            event.target.style.background = 'red';
        },
        reproducir() {
            var audio = new Audio('media/win.mp3');
            audio.play();
        },
        seleccionar(event){
            this.elementSelect = event.target;
            console.log(this.elementSelect);
            console.log(this.elementSelect.onmousedown);
            this.elementSelect.onmousedown = () => this.seleccionElemento(event);
            console.log(this.elementSelect.onmousedown);
            console.log(event);
        },
        seleccionElemento(event){
            console.log("elemento seleccionado");
            console.log(event);
            this.currentX = event.clientX;
            this.currentY = event.clientY;
            this.currentPosX = event.x;//parseFloat(this.elementSelect.getAttribute("x"));
            this.currentPosY = event.y;//parseFloat(this.elementSelect.getAttribute("y"));
            this.elementSelect.onmousemove = this.moverElemento(event);
        },
        insertAttribute(){
            var imgLoader = window.document.getElementById('rompecabezas');
            var piezas = window.document.getElementsByClassName('movil');
            //console.log(this.$refs);
            //var imagenes = this.$attrs
            for (var i = 0; i < 9 ; i++){
                console.log(piezas[i]);
                piezas[i].setAttribute('left','200px' );
                piezas[i].setAttribute('top','200px' );
                piezas[i].setAttribute('width', this.tamWidth[i]);
                piezas[i].setAttribute('height', this.tamHeight[i]);
                //piezas[i].setAttribute('onmousedown', this.seleccionarElemento(event));
            }
        },
        seleccionarElemento(event){
            console.log(event);
            this.elementSelect = event.target;
            this.currentX = event.clientX;
            this.currentY = event.clientY;
            this.currentPosX = parseFloat(this.elementSelect.getAttribute("x"));
            this.currentPosY = parseFloat(this.elementSelect.getAttribute("y"));
            this.elementSelect.setAttribute("mousemove", this.moverElemento(event));
        },
        moverElemento(event){
            var dx = event.clientX - this.currentX;
            var dy = event.clientY - this.currentY;
            this.currentPosx = this.currentPosx + dx;
            this.currentPosy = this.currentPosy + dy;
            this.elementSelect.setAttribute("x", this.currentPosX);
            this.elementSelect.setAttribute("y", this.currentPosY);
            this.currentX = event.clientX;
            this.currentY = event.clientY;
        }
    }
}
</script>

<style>
#entorno {
    position: relative;
    border: dotted;
    width: 600px;
    height: 600px;
    margin: 0 auto;
}

#img{
    position: absolute;
    /*top: 50px;
    left: 100px;*/
    width: 134px;
    height: 164px;
}

#fondo {
    opacity: 0.3;
}

.dragstartzone {
    background-color: red;
    position: relative;
    border: dotted;
    width: 600px;
    height: 600px;
    margin: 0 auto;
}
</style>
