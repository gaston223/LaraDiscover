import ExampleComponent from "./components/ExampleComponent";
import ExampleComponent2 from "./components/ExampleComponent2";
import Bookables from "./bookables/Bookables";
import VueRouter from "vue-router";
const routes = [
    {
        path: "/",
        component: Bookables,
        name: "home",
    },
    {
        path: "/second",
        component: ExampleComponent2,
        name: "second",
    },
]

const router = new VueRouter({
    routes ,//, short for `routes: routes`
    mode:'history',
});

export default router;
