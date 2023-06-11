import axios from 'axios';

export const getProvider = async () => {
  try {
    const {data: results} = await axios.get(`/api/v1/provider`);

    return results;
  } catch (error) {
    throw error;
  }
};
