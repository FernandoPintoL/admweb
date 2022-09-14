<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    components: {
        AppLayout,
    },
    props: ["user"],
    data() {
        return {
            messages: [],
            newMessage: "",
            hasScrolledToBottom: "",
        };
    },
    mounted() {
        this.fetchMessages();
        window.Echo.private("chat-channel").listen("SendMessage", (e) => {
            console.log(e);
            this.messages.push({ message: e.message.message, user: e.user });
        });
    },
    methods: {
        async fetchMessages() {
            await axios
                .get("/messages")
                .then((response) => {
                    this.messages = response.data;
                })
                .catch(function (error) {
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log("Error", error.message);
                    }
                    console.log(error.config);
                });
        },
        async addMessage() {
            let user_message = {
                user: this.user,
                message: this.newMessage,
            };
            await axios
                .post("/messagestore", user_message)
                .then((response) => {
                    console.log(response.data);
                    this.messages.push(user_message);
                })
                .catch(function (error) {
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log("Error", error.message);
                    }
                    console.log(error.config);
                });
            this.newMessage = "";
        },
        scrollBottom() {
            if (this.messages.length > 1) {
                let el = this.hasScrolledToBottom;
                el.scrollTop = el.scrollHeight;
            }
        },
    },
};
</script>
<style type="text/css">
.message p {
    border-radius: 10px;
    padding: 10px 20px 10px 8px;
    margin-top: 5px;
    display: inline-block;
    width: auto;
    margin: 0px;
}
.message-send p {
    background: #e0e3e6;
    color: #2f2d2d;
}
.message-send {
    text-align: right;
    margin-top: 5px;
}
.message-receive p {
    background: #435f7a;
    color: #f5f5f5;
}
.message-receive {
    margin-top: 5px;
}
.scrollable {
    overflow: hidden;
    overflow-y: scroll;
    height: calc(100vh - 25vh);
}
.message-input {
    border: none;
    border-radius: 0px;
    background: #f2f2f2;
}
</style>
<template>
    <AppLayout title="Chat">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                CHAT
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="chat card">
                        <div
                            class="scrollable card-body"
                            ref="hasScrolledToBottom"
                        >
                            <!-- <template v-for="message in messages">
                                <div class="message message-receive" v-if="user.id != message.user.id">
                                    <p>
                                        <strong class="primary-font">
                                            {{ message.user.name }} :
                                        </strong>
                                        {{ message.message }}
                                    </p>
                                </div>
                                <div class="message message-send" v-else>
                                    <p>
                                        <strong class="primary-font">
                                            {{ message.user.name }} :
                                        </strong>
                                        {{ message.message }}
                                    </p>
                                </div>
                            </template> -->
                        </div>

                        <div class="chat-form input-group">
                            <input
                                id="btn-input"
                                type="text"
                                name="message"
                                class="form-control input-sm message-"
                                placeholder="Type your message here..."
                                v-model="newMessage"
                                @keyup.enter="addMessage"
                            />
                            <span class="input-group-btn">
                                <button
                                    class="btn btn-primary"
                                    id="btn-chat"
                                    @click="addMessage"
                                >
                                    Send
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
