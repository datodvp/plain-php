import axios from "axios";

interface ProductService {
    getProducts: () => Promise<any>;
    addProduct: (payload: any) => Promise<any>;
    massDelete: (payload: any) => Promise<any>;
}

export const useApiService = (): ProductService => {
    const apiClient = axios.create({
        baseURL: import.meta.env.VITE_API_URL,
    })

    return {
        async getProducts() {
            return apiClient.get('/api/products')
        },
        async addProduct(payload) {
            return apiClient.post('/api/products', payload)
        },
        async massDelete(payload) {
            return apiClient.post('/api/products/delete', payload)
        }
    }
}