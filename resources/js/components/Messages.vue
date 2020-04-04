<template>
    <ul class="chat">
        <li class="left clearfix" v-for="(message, index) in messages" :key="message + '-' + index">
            <div class="chat-body clearfix"
                >
                <div class="header">
                    <strong class="primary-font">
                        {{ message.user.name }}
                    </strong>
                </div>
                <p>
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['messages']
    }
</script>