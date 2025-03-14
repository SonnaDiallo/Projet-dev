const express = require('express');
const fs = require('fs');
const path = require('path');
const router = express.Router();

const getData = (fileName) => {
    const filePath = path.join(__dirname, `../data/${fileName}`);
    return new Promise((resolve, reject) => {
        fs.readFile(filePath, 'utf8', (err, data) => {
            if (err) {
                reject(err);
                return;
            }
            resolve(JSON.parse(data));
        });
    });
};

router.get('/api/services', async (req, res) => {
    try {
        const data = await getData('services.json');
        res.json(data);
    } catch (error) {
        res.status(500).json({ error: 'Failed to read services data' });
    }
});

router.get('/api/companies', async (req, res) => {
    try {
        const data = await getData('companies.json');
        res.json(data);
    } catch (error) {
        res.status(500).json({ error: 'Failed to read companies data' });
    }
});

router.get('/api/articles', async (req, res) => {
    try {
        const data = await getData('articles.json');
        res.json(data);
    } catch (error) {
        res.status(500).json({ error: 'Failed to read articles data' });
    }
});

module.exports = router;
