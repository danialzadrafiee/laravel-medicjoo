var _0x5e0e79 = _0x14f1;

function _0x14f1(_0xbec386, _0x596b03) {
    var _0xc8960d = _0xc896();
    return _0x14f1 = function (_0x14f116, _0xc15c09) {
        _0x14f116 = _0x14f116 - 0xfb;
        var _0x2635e6 = _0xc8960d[_0x14f116];
        return _0x2635e6;
    }, _0x14f1(_0xbec386, _0x596b03);
}

function _0xc896() {
    var _0xff6573 = ['init', 'audioChunk', 'debug', 'min', 'process', 'port', 'hiiii', 'log', 'action', 'postMessage', '42779364Jsneuz', '_recognizerId', '1OxroST', '5007496ivSGIe', 'floatTo16BitPCM', '11rWCoDh', '44PdjseL', 'data', '232374PuLkjE', '_processMessage', '7gUcSFC', '_recognizerPort', '1799325lNJYHR', '5ZlwVzf', 'length', '426531bXWcBb', 'recognizerId', '3644040YHcAqs', 'Received\x20event\x20', 'recognizer-processor-custom', '244940MMGaje', 'max'];
    _0xc896 = function () {
        return _0xff6573;
    };
    return _0xc896();
}(function (_0x3ad927, _0x39009d) {
    var _0x278ae3 = _0x14f1,
        _0x234b76 = _0x3ad927();
    while (!![]) {
        try {
            var _0x1fcf96 = -parseInt(_0x278ae3(0x110)) / 0x1 * (-parseInt(_0x278ae3(0x102)) / 0x2) + -parseInt(_0x278ae3(0xfd)) / 0x3 * (parseInt(_0x278ae3(0x114)) / 0x4) + -parseInt(_0x278ae3(0xfb)) / 0x5 * (-parseInt(_0x278ae3(0x116)) / 0x6) + -parseInt(_0x278ae3(0x118)) / 0x7 * (parseInt(_0x278ae3(0x111)) / 0x8) + -parseInt(_0x278ae3(0x11a)) / 0x9 + -parseInt(_0x278ae3(0xff)) / 0xa + -parseInt(_0x278ae3(0x113)) / 0xb * (-parseInt(_0x278ae3(0x10e)) / 0xc);
            if (_0x1fcf96 === _0x39009d) break;
            else _0x234b76['push'](_0x234b76['shift']());
        } catch (_0x27e722) {
            _0x234b76['push'](_0x234b76['shift']());
        }
    }
}(_0xc896, 0xed49d));
class RecognizerAudioProcessor extends AudioWorkletProcessor {
    constructor(_0x886032) {
        var _0x3e8a5d = _0x14f1;
        super(_0x886032), this[_0x3e8a5d(0x109)]['onmessage'] = this[_0x3e8a5d(0x117)]['bind'](this), console[_0x3e8a5d(0x10b)](_0x3e8a5d(0x10a));
    } [_0x5e0e79(0x117)](_0x372ba5) {
        var _0x1dd7ae = _0x5e0e79;
        console[_0x1dd7ae(0x10b)](_0x372ba5), console[_0x1dd7ae(0x106)](_0x1dd7ae(0x100) + JSON['stringify'](_0x372ba5[_0x1dd7ae(0x115)], null, 0x2)), _0x372ba5['data'][_0x1dd7ae(0x10c)] === _0x1dd7ae(0x104) && (this[_0x1dd7ae(0x10f)] = _0x372ba5['data'][_0x1dd7ae(0xfe)], this[_0x1dd7ae(0x119)] = _0x372ba5['ports'][0x0]);
    } [_0x5e0e79(0x108)](_0x3e677a, _0xf4e6d4, _0x34ac30) {
        var _0x11b359 = _0x5e0e79;
        const _0xd1f78b = _0x3e677a[0x0][0x0];
        if (this['_recognizerPort'] && _0xd1f78b) {
            const _0x2a39db = this['encodeRAW'](_0xd1f78b);
            this['_recognizerPort'][_0x11b359(0x10d)]({
                'action': _0x11b359(0x105),
                'data': _0x2a39db,
                'recognizerId': this['_recognizerId'],
                'sampleRate': sampleRate
            }, {
                'transfer': [_0x2a39db['buffer']]
            });
        }
        return !![];
    } [_0x5e0e79(0x112)](_0x174cc4, _0xee0594, _0x364c7d) {
        var _0x5bdde3 = _0x5e0e79;
        for (var _0xdda238 = 0x0; _0xdda238 < _0x364c7d[_0x5bdde3(0xfc)]; _0xdda238++, _0xee0594 += 0x2) {
            var _0x4cbfa4 = Math[_0x5bdde3(0x103)](-0x1, Math[_0x5bdde3(0x107)](0x1, _0x364c7d[_0xdda238]));
            _0x174cc4['setInt16'](_0xee0594, _0x4cbfa4 < 0x0 ? _0x4cbfa4 * 0x8000 : _0x4cbfa4 * 0x7fff, !![]);
        }
    } ['encodeRAW'](_0x54a417) {
        var _0x229066 = _0x5e0e79,
            _0x2cd715 = new ArrayBuffer(_0x54a417[_0x229066(0xfc)] * 0x2),
            _0x171e72 = new DataView(_0x2cd715);
        return this['floatTo16BitPCM'](_0x171e72, 0x0, _0x54a417), _0x171e72;
    }
}
registerProcessor(_0x5e0e79(0x101), RecognizerAudioProcessor);