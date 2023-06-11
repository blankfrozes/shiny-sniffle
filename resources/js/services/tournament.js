import axios from 'axios';

export const getWinnerLists = async (page) => {
  try {
    const {data: results} = await axios.get(`/api/v1/tournament`);

    return results;
  } catch (error) {
    throw error;
  }
};
