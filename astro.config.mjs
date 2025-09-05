// @ts-check
import { defineConfig } from 'astro/config';

import sitemap from "@astrojs/sitemap";

export default defineConfig({
    build: {
        assets: 'static',
        format: 'file',
    },

    site: 'https://kier.ovh',

    trailingSlash: 'never', 

    integrations: [
        sitemap({}),
    ],
});
