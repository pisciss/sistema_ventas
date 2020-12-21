<template>
    <button
        class="btn btn-danger btn-sm"
        type="submit"
        @click="eliminarPaciente"
    >
        Eliminar
    </button>
</template>

<script>
export default {
    props: ["pacienteId"],

    methods: {
        eliminarPaciente() {
            this.$swal({
                title: "¿Está seguro de eliminar?",
                text: "Una vez eliminado, no se podrá recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si",
                cancelButtonText: "No"
            }).then(result => {
                if (result.value) {
                    const params = {
                        id: this.pacienteId
                    };
                    axios
                        .post(`/pacientes/${this.pacienteId}`, {
                            params,
                            _method: "delete"
                        })
                        .then(respuesta => {
                            this.$swal({
                                title: "Paciente Eliminado",
                                text: " Se eliminó",
                                icon: "success"
                            });
                            this.$el.parentNode.parentNode.parentNode.removeChild(
                                this.$el.parentNode.parentNode
                            );
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            });
        }
    }
};
</script>
