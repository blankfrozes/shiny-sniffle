import axios from 'axios';

export const getConfigs = async (page) => {
  try {
    const {data: results} = await axios.get(`/api/v1/config`);

    return results;
  } catch (error) {
    throw error;
  }
};

export const siteName = 'Wso99'
export const loginLink = 'https://94.237.73.80/'
export const registerLink = 'https://94.237.73.80/register'
export const appUrl = `https://rtpslotwso99.com`
export const siteImage = `/images/wso99.webp`
