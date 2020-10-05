
import axios from 'axios';
import CurrentOrder from "./components/CurrentOrder";

const app = new Vue({
    el: '#app',
    components: {
        CurrentOrder
    },
    data: function() {
        return {
            hello: 'world'
        };
    },
    mounted() {
        axios.get('/api/catalog')
            .then(function (response) {
                // handle success
                console.log(response);
            })
        ;
    }
});