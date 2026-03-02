const { Component } = Shopware;
const { Criteria } = Shopware.Data;

Component.override('sw-product-detail-specifications', {
    template: `
        {% block sw_product_detail_specifications %}
            {% parent %}
            <arnowa-compliance-hint-card :product="product" />
        {% endblock %}
    `
});

Component.override('sw-product-detail', {
    computed: {
        productCriteria() {
            const criteria = this.$super('productCriteria');
            criteria.addAssociation('arnowaComplianceHint');
            return criteria;
        }
    }
});