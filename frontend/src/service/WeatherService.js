import axios from 'axios';

const BASE_URL = 'http://localhost:8000/api';

const WeatherService = {
  getWeatherByCity: async (city) => {
    try {
      const response = await axios.get(`${BASE_URL}/clima`, {
        params: { cidade: city },
      });
      return response.data;
    } catch (error) {
      console.error('Erro ao buscar clima:', error);
      throw error;
    }
  },
};

export default WeatherService;