// @ts-check
import { defineConfig } from 'astro/config';

import sitemap from "@astrojs/sitemap";

export default defineConfig({
    build: {
        assets: 'static'
    },

    site: 'https://kier.ovh',

    integrations: [
        sitemap({}),
    ],
});
