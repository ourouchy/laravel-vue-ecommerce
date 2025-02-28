import './bootstrap';
import {persist} from "@alpinejs/persist";
import Alpine from 'alpinejs';
import {collapse} from "@alpinejs/collapse";
import {post, get} from "./http.js";

Alpine.plugin(persist)
Alpine.plugin(collapse)

window.Alpine = Alpine;


document.addEventListener("alpine:init", () => {

    Alpine.data("sidebar", () => ({
        active: false,
        position: "",
        bodyDirection: "",
        init() {
            this.position = this.$el.getAttribute("data-position");
            this.bodyDirection = this.position === "left" ? "body:right" : "body:left";
        },
        setup: {
            ["x-show"]() {
                return this.active;
            },
            ["@click.away"]() {
                this.close();
                console.log("Sidebar clicked away");
            },
            [":class"]() {
                return {
                    "left-0 -translate-x-full md:-translate-x-120": this.position === "left",
                    "right-0 translate-x-full md:translate-x-120": this.position === "right"
                };
            }
        },
        open() {
            this.active = true;
            this.$dispatch(this.bodyDirection);
            this.$dispatch("overlay:open");
            console.log("Sidebar open");
        },
        close() {
            this.$dispatch("body:reset");
            this.$dispatch("overlay:close");
            setTimeout(() => {
                this.active = false;
            }, 500);
            console.log("Sidebar closed");
        }
    }));



    Alpine.data("toast", () => ({
        visible: false,
        delay: 5000,
        percent: 0,
        interval: null,
        timeout: null,
        message: null,
        type: null,
        close() {
            this.visible = false;
            clearInterval(this.interval);
        },
        show(message, type = 'success') {
            this.visible = true;
            this.message = message;
            this.type = type;

            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
            if (this.timeout) {
                clearTimeout(this.timeout);
                this.timeout = null;
            }

            this.timeout = setTimeout(() => {
                this.visible = false;
                this.timeout = null;
            }, this.delay);
            const startDate = Date.now();
            const futureDate = Date.now() + this.delay;
            this.interval = setInterval(() => {
                const date = Date.now();
                this.percent = ((date - startDate) * 100) / (futureDate - startDate);
                if (this.percent >= 100) {
                    clearInterval(this.interval);
                    this.interval = null;
                }
            }, 30);
        },
    }));
    Alpine.data("productItem", (product) => {
        return {
            product,
            addToCart(quantity = 1) {
                post(this.product.addToCartUrl, {quantity})
                    .then(result => {
                        this.$dispatch('cart-change', {count: result.count})
                        this.$dispatch("notify", {
                            message: "The item was added to the cart",
                        });


                    })
                    .catch(response => {
                        this.$dispatch('notify', {
                            message: response.message || 'Server Error. Please try again.',
                            type: 'error'
                        })
                    })
            },
            removeItemFromCart() {
                post(this.product.removeUrl)
                    .then(result => {
                        this.$dispatch("notify", {
                            message: "The item was removed from cart",
                        });
                        this.$dispatch('cart-change', {count: result.count})
                        this.cartItems = this.cartItems.filter(p => p.id !== product.id)
                    })
            },
            changeQuantity(){
                post(this.product.updateQuantityUrl, {quantity: product.quantity})
                    .then(result => {
                        this.$dispatch('cart-change', {count: result.count})
                        this.$dispatch("notify", {
                            message: "The item quantity was updated",
                        });
                    })
                    .catch(response => {
                        this.$dispatch('notify', {
                            message: response.message || 'Server Error. Please try again.',
                            type: 'error'
                        })
                    })
            }
        };
    });

});

window.Alpine = Alpine;
Alpine.start();
