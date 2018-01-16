const ApiService = require("services/ApiService");

Vue.component("order-history", {

    delimiters: ["${", "}"],

    props: [
        "template"
    ],

    data()
    {
        return {
            currentOrder: null
        };
    },

    created()
    {
        this.$options.template = this.template;
    },

    methods:
    {
        setCurrentOrder(order)
        {
            $("#dynamic-twig-content").html("");
            this.isLoading = true;
            this.currentOrder = order;

            Vue.nextTick(() =>
            {
                $(this.$refs.orderDetails).modal("show");
            });

            ApiService
                .get("/rest/io/order/template?template=Ceres::Checkout.OrderDetails&orderId=" + order.order.id)
                .done(response =>
                {
                    this.isLoading = false;
                    $("#dynamic-twig-content").html(response);
                });
        },

        getPaymentStateText(paymentStates)
        {
            for (const paymentState in paymentStates)
            {
                if (paymentStates[paymentState].typeId == 4)
                {
                    return Translations.Template["paymentStatus_" + paymentStates[paymentState].value];
                }
            }

            return "";
        }
    }
});
