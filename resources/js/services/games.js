import axios from 'axios';

export const getGames = async (slug, page, search) => {

  let query = "";

  if (!search) {
    query = "?page=" + page;
  }else if (search){
    query = "?search=" + search;
  };

  try {
    const {data: results} = await axios.get(`/api/v1/games/${slug}${query}`);

    return results;
  } catch (error) {
    throw error;
  }
};
