FROM node:lts-alpine

COPY . /app

WORKDIR /app

RUN npm install

EXPOSE 8080

CMD ["npm", "run", "serve"]