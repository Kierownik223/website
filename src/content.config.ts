import { defineCollection } from "astro:content";
import { z } from "astro/zod";
import { glob } from "astro/loaders";

const equipmentCollection = defineCollection({
    loader: glob({ base: './src/content/equipment', pattern: '**/*.{md,mdx}' }),
    schema: z.object({
        priority: z.number().optional(),
        meaningful: z.boolean().optional(),
        title: z.string(),
        category: z.string(),
        description: z.string(),
        count: z.number().default(1),
    }),
});

export const collections = {
    equipment: equipmentCollection
};
