import template from './arnowa-compliance-hint-card.html.twig';

const { Component } = Shopware;

Component.register('arnowa-compliance-hint-card', {
    template,

    inject: ['repositoryFactory'],

    props: {
        product: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            hintEntity: null,
            localHintRequired: false,
            localHintText: '',
            isInitializing: false,
            saveTextTimer: null
        };
    },

    watch: {
        'product.id': {
            immediate: true,
            handler(id) {
                if (id) {
                    this.initHint();
                }
            }
        },

        localHintRequired() {
            if (this.isInitializing) return;
            this.saveHint();
        },

        localHintText() {
            if (this.isInitializing) return;
            clearTimeout(this.saveTextTimer);
            this.saveTextTimer = setTimeout(() => {
                this.saveHint();
            }, 800);
        }
    },

    methods: {
        initHint() {
            this.isInitializing = true;
            const existing = this.product?.extensions?.arnowaComplianceHint;
            const repository = this.repositoryFactory.create('arnowa_compliance_hint');

            if (existing && existing.id) {
                this.hintEntity = existing;
                this.localHintRequired = existing.hintRequired ?? false;
                this.localHintText = existing.hintText ?? '';
            } else {
                const entity = repository.create(Shopware.Context.api);
                entity.productId = this.product.id;
                entity.productVersionId = this.product.versionId;
                entity.hintRequired = false;
                entity.hintText = '';
                this.hintEntity = entity;
            }

            this.$nextTick(() => {
                this.isInitializing = false;
            });
        },

        async saveHint() {
            if (!this.hintEntity || !this.product.id) return;

            this.hintEntity.hintRequired = this.localHintRequired;
            this.hintEntity.hintText = this.localHintText;

            const repository = this.repositoryFactory.create('arnowa_compliance_hint');

            try {
                await repository.save(this.hintEntity, Shopware.Context.api);
            } catch (e) {
                console.error('API Fehler:', JSON.stringify(e.response?.data, null, 2));
            }
        },

        onTextInput(value) {
    if (this.isInitializing) return;
    this.localHintText = value;
    clearTimeout(this.saveTextTimer);
    this.saveTextTimer = setTimeout(() => {
        this.saveHint();
    }, 800);
}
    }
});