import { defineCollection, z } from "astro:content";

const equipmentCollection = defineCollection({
    schema: z.object({
        priority: z.number().optional(),
        title: z.string(),
        category: z.string(),
        description: z.string(),
        count: z.number().default(1),
    }),
});

export const collections = {
    equipment: equipmentCollection
};
