import axios from "axios";
import { ref } from "vue";
const GET_RESTAURANTS_URL = "/api/restaurants";

const restaurants = ref([]);
const restaurantsRes = ref({});

export function useRestaurants() {
    const getRestaurants = async (params) => {
        try {
            const response = await axios(GET_RESTAURANTS_URL, { params });
            const {header,data,status} = response;
            restaurantsRes.value = data;
            restaurants.value = data.results.map((restaurant) => ({
                ...restaurant,
                location: JSON.stringify(restaurant.location),
            }));
        } catch (error) {
            console.error("Error loading restaurants", error);
        }
    };

    return {
        restaurants,
        restaurantsRes,
        getRestaurants
    };
}